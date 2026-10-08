<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $salons = Salon::with('users')->get();
        return view('auth.login', compact('salons'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Set current active salon in session
            $user = Auth::user();
            if ($user->salon_id) {
                session(['active_salon_id' => $user->salon_id]);
            } else {
                $firstSalon = Salon::first();
                if ($firstSalon) {
                    session(['active_salon_id' => $firstSalon->id]);
                }
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function quickLogin($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();

            if ($user->salon_id) {
                session(['active_salon_id' => $user->salon_id]);
            } else {
                $firstSalon = Salon::first();
                if ($firstSalon) {
                    session(['active_salon_id' => $firstSalon->id]);
                }
            }

            return redirect()->route('dashboard')->with('success', 'Logged in as ' . $user->name);
        }

        return redirect()->route('login')->with('error', 'Demo user not found.');
    }

    public function switchSalon($id)
    {
        $salon = Salon::findOrFail($id);
        session(['active_salon_id' => $salon->id]);

        return back()->with('success', 'Switched to ' . $salon->name);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
