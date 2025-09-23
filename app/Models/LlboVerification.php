<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LlboVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_number',
        'license_type',
        'issue_date',
        'expiry_date',
        'status',
        'verification_notes',
        'document_path',
        'verified_by',
        'verified_at',
        'reminder_sent_at'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'verified_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('expiry_date', '<=', Carbon::now()->addDays($days))
                    ->where('expiry_date', '>', Carbon::now())
                    ->where('status', 'verified');
    }

    // Accessors
    public function getDaysUntilExpiryAttribute()
    {
        return Carbon::now()->diffInDays($this->expiry_date, false);
    }

    public function getIsExpiredAttribute()
    {
        return $this->expiry_date < Carbon::now();
    }

    public function getIsExpiringSoonAttribute()
    {
        return $this->days_until_expiry <= 30 && $this->days_until_expiry > 0;
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'verified' => 'success',
            'expired' => 'danger',
            'rejected' => 'danger',
            default => 'secondary'
        };
    }

    // Methods
    public function markAsVerified($verifiedBy, $notes = null)
    {
        $this->update([
            'status' => 'verified',
            'verified_by' => $verifiedBy,
            'verified_at' => now(),
            'verification_notes' => $notes
        ]);
    }

    public function markAsRejected($verifiedBy, $notes = null)
    {
        $this->update([
            'status' => 'rejected',
            'verified_by' => $verifiedBy,
            'verified_at' => now(),
            'verification_notes' => $notes
        ]);
    }

    public function markAsExpired()
    {
        $this->update(['status' => 'expired']);
    }

    public function sendReminder()
    {
        $this->update(['reminder_sent_at' => now()]);
        // Here you would implement email/notification logic
    }
}