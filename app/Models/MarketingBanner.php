<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MarketingBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'welcome_message',
        'button_text',
        'button_url',
        'is_active',
        'display_order',
        'start_date',
        'end_date',
        'target_audience'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'target_audience' => 'array',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrentlyActive($query)
    {
        $now = Carbon::now();
        return $query->where('is_active', true)
                    ->where(function($q) use ($now) {
                        $q->whereNull('start_date')
                          ->orWhere('start_date', '<=', $now);
                    })
                    ->where(function($q) use ($now) {
                        $q->whereNull('end_date')
                          ->orWhere('end_date', '>=', $now);
                    });
    }

    public function scopeForAudience($query, $audience = 'all')
    {
        return $query->where(function($q) use ($audience) {
            $q->whereJsonContains('target_audience', 'all')
              ->orWhereJsonContains('target_audience', $audience);
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getIsCurrentlyActiveAttribute()
    {
        $now = Carbon::now();
        
        if (!$this->is_active) {
            return false;
        }
        
        if ($this->start_date && $this->start_date > $now) {
            return false;
        }
        
        if ($this->end_date && $this->end_date < $now) {
            return false;
        }
        
        return true;
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    // Methods
    public function activate()
    {
        $this->update(['is_active' => true]);
    }

    public function deactivate()
    {
        $this->update(['is_active' => false]);
    }

    public function isTargetedFor($audience)
    {
        $targets = $this->target_audience ?? ['all'];
        return in_array('all', $targets) || in_array($audience, $targets);
    }
}