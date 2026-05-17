<?php

namespace App\Http\Controllers;

use App\Models\Tutoring;
use App\Models\Booking;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\TutoringRequest;

class TutoringController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('q');
        $subjectFilter = $request->input('subject');
        $subjects = Subject::defaultSubjects();

        // Logic for Tutorings (Filter out those already paid)
        $tutoringsQuery = Tutoring::with('user')->whereDoesntHave('bookings', function($q) {
            $q->where('payment_status', 'paid');
        });
        
        if ($search) {
            $tutoringsQuery->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('topics', 'like', "%{$search}%")
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($subjectFilter && $subjectFilter !== 'Todos') {
            $tutoringsQuery->where('subject', $subjectFilter);
        }

        $tutorings = $tutoringsQuery->latest()->paginate(6, ['*'], 'tutorings_page')->withQueryString();

        // Logic for Academic Materials
        $materialsQuery = \App\Models\AcademicMaterial::with('tutor');
        if ($search) {
            $materialsQuery->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('tutor', function($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }
        $materials = $materialsQuery->latest()->paginate(6, ['*'], 'materials_page')->withQueryString();

        return view('dashboard.student.search-tutors', compact('tutorings', 'materials', 'search', 'subjectFilter', 'subjects'));
    }

    public function store(TutoringRequest $request)
    {
        $validated = $request->validated();

        $userId = auth()->id(); 

        Tutoring::create([
            'user_id' => $userId,
            'subject' => $validated['subject'],
            'topics' => $validated['topics'],
            'price' => $validated['price'] ?? 0,
            'scheduled_date' => implode(',', $validated['scheduled_days']),
            'availability' => $validated['availability'],
            'scheduled_time' => implode(', ', $validated['availability']), // For backward compatibility or display
        ]);

        return redirect()->route('dashboard.tutor')->with('success', 'Oferta publicada correctamente.');
    }

    public function create()
    {
        $subjects = Subject::defaultSubjects();
        return view('dashboard.tutor.post-tutoring', compact('subjects'));
    }

    public function showBook(Tutoring $tutoring)
    {
        if ($tutoring->user_id === auth()->id()) {
            return redirect()->route('dashboard.search')->withErrors(['error' => 'No puedes agendar tu propia tutoría.']);
        }
        $user = auth()->user();
        return view('dashboard.student.book-tutoring', compact('tutoring', 'user'));
    }

    public function confirmBook(Request $request, Tutoring $tutoring)
    {
        if ($tutoring->user_id === auth()->id()) {
            return redirect()->route('dashboard.search')->withErrors(['error' => 'No puedes agendar tu propia tutoría.']);
        }

        $validated = $request->validate([
            'date' => 'required|string',
            'time' => 'required|string',
        ]);

        // Logic for creating the booking directly (Free of charge)
        $booking = Booking::create([
            'student_id' => auth()->id(),
            'tutoring_id' => $tutoring->id,
            'booking_date' => $validated['date'],
            'booking_time' => $validated['time'],
            'total_price' => 0.00,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // Process this free booking immediately
        return $this->processPayment($request, $booking);
    }

    public function processPayment(Request $request, Booking $booking)
    {
        // Load relationships to ensure data is available
        $booking->load(['tutoring.user']);

        if ($booking->payment_status === 'paid') {
            return redirect()->route('dashboard.student')->with('success', 'La sesión ya fue procesada anteriormente.');
        }

        if ($booking->student_id !== auth()->id()) {
            abort(403);
        }

        $meetLink = 'https://meet.google.com/' . strtolower(Str::random(3) . '-' . Str::random(4) . '-' . Str::random(3));

        $booking->update([
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        $user = auth()->user();

        try {
            // Enviar al estudiante
            $responseStudent = Http::withHeaders([
                'api-key' => config('services.brevo.key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.brevo.com/v3/smtp/email', [
                'sender' => [
                    'name' => config('services.brevo.from_name'),
                    'email' => config('services.brevo.from_email'),
                ],
                'to' => [
                    ['email' => $user->email, 'name' => $user->name]
                ],
                'subject' => 'Confirmación de Agenda y Enlace de Tutoría - OpenBook',
                'htmlContent' => view('emails.tutoring_payment', [
                    'booking' => $booking,
                    'user' => $user,
                    'meetLink' => $meetLink
                ])->render(),
            ]);

            if ($responseStudent->failed()) {
                Log::error('Brevo Email Failed (Student): ' . $responseStudent->body());
            }
        } catch (\Exception $e) {
            Log::error('Brevo Connection Error (Student): ' . $e->getMessage());
        }

        // Enviar al tutor / encargado
        $assignee = null;
        if ($booking->tutoring) {
            $assignee = $booking->tutoring->user;
        }

        if ($assignee) {
            try {
                $responseAssignee = Http::withHeaders([
                    'api-key' => config('services.brevo.key'),
                    'Content-Type' => 'application/json',
                ])->post('https://api.brevo.com/v3/smtp/email', [
                    'sender' => [
                        'name' => config('services.brevo.from_name'),
                        'email' => config('services.brevo.from_email'),
                    ],
                    'to' => [
                        ['email' => $assignee->email, 'name' => $assignee->name]
                    ],
                    'subject' => 'Nueva Tutoría Agendada - OpenBook',
                    'htmlContent' => view('emails.tutor_notification', [
                        'booking' => $booking,
                        'assignee' => $assignee,
                        'student' => $user,
                        'meetLink' => $meetLink
                    ])->render(),
                ]);

                if ($responseAssignee->failed()) {
                    Log::error('Brevo Email Failed (Assignee): ' . $responseAssignee->body());
                }
            } catch (\Exception $e) {
                Log::error('Brevo Connection Error (Assignee): ' . $e->getMessage());
            }
        }

        return redirect()->route('dashboard.student')->with('success', 'Tutoría agendada exitosamente. Se ha enviado un correo con los detalles y el enlace de la sesión.');
    }
}
