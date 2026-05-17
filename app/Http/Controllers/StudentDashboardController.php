<?php

namespace App\Http\Controllers;

use App\Models\Tutoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Booking;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'student') {
            return redirect()->route('dashboard.tutor');
        }
        
        // Fetch all tutoring offers that are available
        $availableTutorings = Tutoring::with('user')
            ->latest()
            ->get();
        
        $totalTutorings = $availableTutorings->count();
        $totalTutors = $availableTutorings->pluck('user_id')->unique()->count();
        
        // Booked sessions count for the student
        $myBookedSessionsCount = Booking::where('student_id', $user->id)->count();

        return view('dashboard.student.student', compact(
            'user', 
            'availableTutorings', 
            'totalTutorings', 
            'totalTutors',
            'myBookedSessionsCount'
        ));
    }

    public function history()
    {
        $user = Auth::user();
        if ($user->role !== 'student') {
            return redirect()->route('dashboard.tutor');
        }
        
        // Tutorías que tomé como alumno
        $takenTutorings = Booking::where('student_id', $user->id)
            ->whereNotNull('tutoring_id')
            ->with(['tutoring.user'])
            ->latest()
            ->paginate(10, ['*'], 'tutorings_taken_page')->withQueryString();

        $totalServices = $takenTutorings->total();
        $totalHours = $totalServices * 1.5; 
        $pendingReviews = 0;

        return view('dashboard.student.history', compact(
            'user', 
            'takenTutorings',
            'totalServices', 
            'totalHours', 
            'pendingReviews'
        ));
    }

    public function profile()
    {
        $user = Auth::user();
        if ($user->role !== 'student') {
            return redirect()->route('dashboard.tutor');
        }
        
        // Dynamic stats for profile focusing on tutorings
        $myBookingsCount = Booking::where('student_id', $user->id)->count();
        $recentActivity = Booking::where('student_id', $user->id)->with('tutoring')->latest()->take(3)->get();
        
        return view('dashboard.student.profile', compact('user', 'myBookingsCount', 'recentActivity'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'student') {
            return redirect()->route('dashboard.tutor');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'program' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            if ($user->profile_photo_path && !Str::startsWith($user->profile_photo_path, 'data:image/')) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $mimeType = $file->getMimeType();
            $imageData = base64_encode(file_get_contents($file->getRealPath()));
            $validated['profile_photo_path'] = "data:{$mimeType};base64,{$imageData}";
        }

        $user->update($validated);

        return back()->with('success', 'Perfil actualizado exitosamente.');
    }
}
