<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.update');
    Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);

    Route::get('verify-email', [VerifyEmailController::class, 'showVerifyEmailForm'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, 'verifyEmail'])->name('verification.verify');
    Route::post('email/verification-notification', [VerifyEmailController::class, 'sendEmailVerificationNotification'])->name('verification.send');
});
