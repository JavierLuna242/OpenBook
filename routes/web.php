<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutoringController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TutorDashboardController;
use App\Http\Controllers\StudentJobController;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard.student');
    }
    return response()->view('welcome')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
})->name('welcome');

Route::post('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/login', [AuthController::class, 'showPortalLogin'])->name('login');
Route::get('/login/estudiante', [AuthController::class, 'showStudentLogin'])->name('login.student');
Route::post('/login/estudiante', [AuthController::class, 'studentLogin']);
Route::get('/login/tutor', [AuthController::class, 'showTutorLogin'])->name('login.tutor');
Route::post('/login/tutor', [AuthController::class, 'tutorLogin']);

Route::get('/register', [AuthController::class, 'showPortalRegister'])->name('register');
Route::get('/register/estudiante', [AuthController::class, 'showStudentRegister'])->name('register.student');
Route::post('/register/estudiante', [AuthController::class, 'studentRegister']);
Route::get('/register/tutor', [AuthController::class, 'showTutorRegister'])->name('register.tutor');
Route::post('/register/tutor', [AuthController::class, 'tutorRegister']);

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Student Routes
    Route::get('/dashboard/estudiante', [StudentDashboardController::class, 'index'])->name('dashboard.student');
    Route::get('/dashboard/buscar-tutorias', [TutoringController::class, 'index'])->name('dashboard.search');
    Route::get('/dashboard/historial', [StudentDashboardController::class, 'history'])->name('dashboard.history');
    Route::get('/dashboard/perfil', [StudentDashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('/dashboard/perfil', [StudentDashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    
    // Student Booking Routes
    Route::get('/dashboard/reservar-tutoria/{tutoring}', [TutoringController::class, 'showBook'])->name('dashboard.book');
    Route::post('/dashboard/reservar-tutoria/{tutoring}', [TutoringController::class, 'confirmBook'])->name('dashboard.book.confirm');
    
    // Academic Materials Download (Student & Tutor)
    Route::get('/dashboard/material/{material}/download', [App\Http\Controllers\AcademicMaterialController::class, 'download'])->name('dashboard.materials.download');

    // Tutor Routes
    Route::get('/dashboard/tutor', [TutorDashboardController::class, 'index'])->name('dashboard.tutor');
    Route::get('/dashboard/tutor/publicar', [TutoringController::class, 'create'])->name('dashboard.tutor.post');
    Route::post('/dashboard/tutor/publicar', [TutoringController::class, 'store'])->name('dashboard.tutor.store');
    Route::get('/dashboard/tutor/historial', [TutorDashboardController::class, 'history'])->name('dashboard.tutor.history');
    Route::get('/dashboard/tutor/perfil', [TutorDashboardController::class, 'profile'])->name('dashboard.tutor.profile');
    Route::post('/dashboard/tutor/perfil', [TutorDashboardController::class, 'updateProfile'])->name('dashboard.tutor.profile.update');
    
    // Tutor Materials Routes
    Route::get('/dashboard/tutor/materiales', [App\Http\Controllers\AcademicMaterialController::class, 'index'])->name('dashboard.tutor.materials');
    Route::post('/dashboard/tutor/materiales', [App\Http\Controllers\AcademicMaterialController::class, 'store'])->name('dashboard.tutor.materials.store');
    Route::delete('/dashboard/tutor/materiales/{material}', [App\Http\Controllers\AcademicMaterialController::class, 'destroy'])->name('dashboard.tutor.materials.destroy');
});
