<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && $user->token === $request->token) {
            $user->update([
                'password' => $request->password,
                'token' => null,
            ]);
            return redirect('/login')->with('success', 'Password reset successful.');
        }
        return back()->withErrors(['email' => 'Invalid token or email.']);
    }
}
