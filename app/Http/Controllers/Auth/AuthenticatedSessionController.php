<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('auth/login');
    }
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Regenerasi sesi untuk mencegah session fixation
            $request->session()->regenerate();

            $user = Auth::user();

            // dd($user);

            // Redirect berdasarkan role_id
            if ($user->role == 1) {
                return redirect()->intended('/admin/dashboard');
            }

            if ($user->role == 2) {
                return redirect()->intended('/user/dashboard');
            }

            // Fallback default jika ada role_id lain
            return redirect()->intended('/');
        }

        return back()
            ->withErrors([
                'email' => 'Kredensial yang diberikan tidak sesuai dengan data kami.',
            ])
            ->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
