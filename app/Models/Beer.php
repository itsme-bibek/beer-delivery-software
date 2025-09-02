<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $fillable = [
        'name',
        'category',
        'image',
        'stock',
        'price',
        'description',
        'alcohol_percentage',
        'origin',
        'status'
    ];

    protected $casts = [
        'stock' => 'integer',
        'price' => 'decimal:2',
        'alcohol_percentage' => 'decimal:2',
    ];

    // Check if beer is available (has stock and is active)
    public function isAvailable(): bool
    {
        return $this->stock > 0 && $this->status === 'active';
    }

    // Get availability status
    public function getAvailabilityStatus(): string
    {
        if ($this->status !== 'active') {
            return 'inactive';
        }
        
        if ($this->stock <= 0) {
            return 'out_of_stock';
        }
        
        if ($this->stock <= 10) {
            return 'low_stock';
        }
        
        return 'in_stock';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
