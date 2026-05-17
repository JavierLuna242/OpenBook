<?php

namespace App\Http\Controllers;

use App\Models\Tutoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Booking;

class TutorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'tutor') {
            return redirect()->route('dashboard.student');
        }
        
        // Fetch all tutoring IDs for this tutor to calculate complete stats
        $allTutoringIds = Tutoring::where('user_id', $user->id)->pluck('id');

        // Fetch bookings related to ALL tutorings of this tutor
        $bookings = Booking::whereIn('tutoring_id', $allTutoringIds)->with(['student', 'tutoring'])->get();

        // My Active Tutoring Offers
        $myTutorings = Tutoring::where('user_id', $user->id)->get();

        // Consolidated stats
        $completedServices = $bookings->where('status', 'confirmed')->count();
        $upcomingTutoringsCount = $bookings->where('status', 'confirmed')->count();
        
        // Get confirmed requests for the "Próximas Tutorías" section
        $upcomingTutorings = $bookings->where('status', 'confirmed');

        return view('dashboard.tutor.tutor', compact(
            'user', 
            'myTutorings', 
            'completedServices', 
            'upcomingTutoringsCount',
            'upcomingTutorings'
        ));
    }

    public function profile()
    {
        $user = Auth::user();
        if ($user->role !== 'tutor') {
            return redirect()->route('dashboard.student');
        }
        
        // Dynamic stats for tutor profile
        $tutoringsCount = Tutoring::where('user_id', $user->id)->count();
        $recentTutorings = Tutoring::where('user_id', $user->id)->latest()->take(3)->get();
        
        return view('dashboard.tutor.tutor-profile', compact('user', 'tutoringsCount', 'recentTutorings'));
    }

    public function history()
    {
        $user = Auth::user();
        if ($user->role !== 'tutor') {
            return redirect()->route('dashboard.student');
        }
        
        // Tutorías dadas por mí
        $completedBookings = Booking::whereHas('tutoring', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['student', 'tutoring'])->latest()
        ->paginate(10, ['*'], 'tutorings_page')->withQueryString();

        // Mis Ofertas de Tutoría
        $myTutoringOffers = Tutoring::where('user_id', $user->id)->latest()->get();

        $totalServices = $completedBookings->total();
        $totalHours = $totalServices * 1.5; 

        return view('dashboard.tutor.tutor-history', compact(
            'user', 
            'completedBookings', 
            'myTutoringOffers',
            'totalServices', 
            'totalHours'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'tutor') {
            return redirect()->route('dashboard.student');
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
