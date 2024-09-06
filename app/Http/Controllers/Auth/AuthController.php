<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        Auth::login($user);
        return redirect()->intended('home')->with('success', 'Registration successful.');
    }
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function showLoginForm()
    {
        Auth::logout();
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'sometimes|boolean', // Validasi remember token
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        $user = User::where('email', $credentials['email'])->first();
        if ($user && $user->attemptLogin($credentials, $remember)) {
            return redirect()->intended('home')->with('success', 'Login successful.');
        }
        return back()->withErrors(['email' => 'Invalid credentials or too many login attempts.']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
