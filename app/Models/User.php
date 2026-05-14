<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    const ROLE_ADMIN   = 'admin';
    const ROLE_CASHIER = 'cashier';
    const ROLE_USER    = 'user';

    protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'avatar', 'venus_points'];
    protected $hidden   = ['password', 'remember_token'];

    protected function casts(): array {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }

    public function getAvatarUrlAttribute(): string {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return asset('images/default-avatar.png');
    }

    public function bookings() { return $this->hasMany(Booking::class); }
    public function orders() { return $this->hasMany(Order::class); }
    public function isAdmin(): bool   { return $this->role === self::ROLE_ADMIN; }
    public function isCashier(): bool { return $this->role === self::ROLE_CASHIER; }
    public function isUser(): bool    { return $this->role === self::ROLE_USER; }
}
