<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;


class AuthController extends Controller
{
    public function showPortalLogin()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role === 'tutor' ? 'dashboard.tutor' : 'dashboard.student');
        }
        return view('auth.login');
    }

    public function showPortalRegister()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role === 'tutor' ? 'dashboard.tutor' : 'dashboard.student');
        }
        return view('auth.register');
    }

    public function showStudentLogin()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role === 'tutor' ? 'dashboard.tutor' : 'dashboard.student');
        }
        return view('auth.login-student');
    }

    public function studentLogin(LoginRequest $request)
    {
        $request->authenticate();

        if (Auth::user()->role !== 'student') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return back()->withErrors(['email' => __('messages.val_not_student_account')]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard.student');
    }

    public function showTutorLogin()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role === 'tutor' ? 'dashboard.tutor' : 'dashboard.student');
        }
        return view('auth.login-tutor');
    }

    public function tutorLogin(LoginRequest $request)
    {
        $request->authenticate();

        if (Auth::user()->role !== 'tutor') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return back()->withErrors(['email' => __('messages.val_not_tutor_account')]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard.tutor');
    }


    public function showStudentRegister()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role === 'tutor' ? 'dashboard.tutor' : 'dashboard.student');
        }
        return view('auth.register-student');
    }

    public function studentRegister(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'program'    => $validated['program'],
            'student_id' => $validated['student_id'],
            'password'   => Hash::make($validated['password']),
            'role'       => 'student',
        ]);

        return redirect()->route('login')->with('success', __('messages.flash_account_created'));
    }

    public function showTutorRegister()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role === 'tutor' ? 'dashboard.tutor' : 'dashboard.student');
        }
        return view('auth.register-tutor');
    }

    public function tutorRegister(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'program'    => $validated['program'],
            'cedula'     => $validated['cedula'],
            'password'   => Hash::make($validated['password']),
            'role'       => 'tutor',
        ]);

        return redirect()->route('login.tutor')->with('success', __('messages.flash_account_created'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => __('messages.val_email_required'),
            'email.email'    => __('messages.val_email_email'),
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => __('messages.val_user_not_found')]);
        }

        // Generar un token único
        $token = Str::random(60);

        // Guardar el token en la base de datos (o actualizar si ya existe)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token'      => $token,
                'created_at' => now(),
            ]
        );

        $resetLink = route('password.reset', ['token' => $token, 'email' => $user->email]);

        // Enviar usando la API de Brevo
        $response = Http::withHeaders([
            'api-key'      => config('services.brevo.key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name'  => config('services.brevo.from_name'),
                'email' => config('services.brevo.from_email'),
            ],
            'to' => [
                ['email' => $user->email, 'name' => $user->name],
            ],
            'subject'     => 'Recuperación de Contraseña - OpenBook',
            'htmlContent' => view('emails.recovery', ['resetLink' => $resetLink, 'user' => $user])->render(),
        ]);

        if ($response->failed()) {
            return back()->withErrors(['email' => __('messages.val_email_send_fail')]);
        }

        return back()->with('success', __('messages.flash_email_sent'));
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'token.required'     => __('messages.val_token_required'),
            'email.required'     => __('messages.val_email_required'),
            'email.email'        => __('messages.val_email_email'),
            'password.required'  => __('messages.val_password_required'),
            'password.min'       => __('messages.val_password_min'),
            'password.confirmed' => __('messages.val_password_confirmed'),
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => __('messages.val_reset_invalid')]);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => __('messages.val_user_not_found')]);
        }

        // Validar que la nueva contraseña no sea igual a la actual
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => __('messages.val_password_same')]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Borrar el token usado
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', __('messages.flash_password_reset'));
    }
}
