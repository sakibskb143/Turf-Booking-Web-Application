<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Booking;
use App\Models\UserNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all bookings for this user
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }

    /**
     * Get all notifications for this user
     */
    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class, 'user_id', 'id');
    }
}
