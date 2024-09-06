<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable, FileUploadTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'try_login',
        'last_login_at',
        'last_login_ip',
        'last_login_device',
        'last_login_browser',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    /**
     * Get the user's profile picture.
     *
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        return $this->avatar ?? "https://ui-avatars.com/api/?name=" . $this->name . "&background=0D8ABC&color=fff";
    }
    /**
     * Update the user's profile picture.
     *
     * @param  string  $value
     * @return void
     */
    public function uploadAvatar(UploadedFile $file)
    {
        $directory = 'avatars';
        $filePath = $this->uploadFile($file, $directory, 300, 300); // Resize ke ukuran 300x300
        $this->update(['avatar' => $filePath]);
        return $filePath;
    }
    /**
     * Update the user's profile picture.
     *
     * @param  string  $value
     * @return void
     */
    public function updateAvatar(UploadedFile $file)
    {
        $directory = 'avatars';
        $filePath = $this->updateFile($file, $directory, $this->avatar, 300, 300); // Resize ke ukuran 300x300
        $this->update(['avatar' => $filePath]);
        return $filePath;
    }
    /**
     * Delete the user's profile picture.
     *
     * @return void
     */
    public function deleteAvatar()
    {
        $this->deleteFile($this->avatar);
        $this->update(['avatar' => null]);
    }
    /**
     * Attempt to log the user into the application.
     *
     * @param  string  $password
     * @return bool
     */
    public function attemptLogin($credentials, $remember = false)
    {
        if ($this->try_login >= 3) {
            return false;
        }
        if (Auth::attempt($credentials, $remember)) {
            $this->resetLoginAttempts();
            $this->updateLoginDetails();
            request()->session()->regenerate();
            return true;
        } else {
            $this->incrementLoginAttempts();
            return false;
        }
    }
    /**
     * Increment the user's login attempts.
     *
     * @return void
     */
    protected function incrementLoginAttempts()
    {
        $this->increment('try_login');
        $this->save();
    }
    /**
     * Reset the user's login attempts.
     *
     * @return void
     */
    protected function resetLoginAttempts()
    {
        $this->update(['try_login' => 0]);
    }
    /**
     * Update the user's login details.
     *
     * @return void
     */
    protected function updateLoginDetails()
    {
        $this->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
            'last_login_device' => request()->header('User-Agent'),
            'last_login_browser' => request()->header('User-Agent'),
        ]);
    }
    /**
     * Check the user's password.
     *
     * @param  string  $password
     * @return bool
     */
    protected function checkPassword($credentials, $remember = false)
    {
        return Auth::attempt($credentials, $remember);
    }
}
