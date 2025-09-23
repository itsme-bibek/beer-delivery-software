<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * User's orders relationship
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * User's messages relationship
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * User's LLBO verification relationship
     */
    public function llboVerification()
    {
        return $this->hasOne(LlboVerification::class);
    }

    /**
     * Check if user has verified LLBO license
     */
    public function hasVerifiedLicense(): bool
    {
        return $this->llboVerification && $this->llboVerification->status === 'verified' && !$this->llboVerification->is_expired;
    }

    /**
     * Get user's last purchase date
     */
    public function getLastPurchaseDate()
    {
        return $this->orders()->latest()->first()?->created_at;
    }

    /**
     * Get user's total spent amount
     */
    public function getTotalSpent()
    {
        return $this->orders()->sum('total_price');
    }
}
