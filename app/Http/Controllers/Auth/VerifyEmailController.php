<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function showVerifyEmailForm()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail($id, $hash)
    {
        $user = User::findOrFail($id);
        if ($user->hasVerifiedEmail()) {
            return redirect('home')->with('success', 'Email already verified.');
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        return redirect('home')->with('success', 'Email verified successfully.');
    }

    public function sendEmailVerificationNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Email verification link sent.');
    }
}
