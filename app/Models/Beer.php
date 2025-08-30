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
        'origin'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
