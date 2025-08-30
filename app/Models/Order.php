<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'beer_id',
        'quantity',
        'status',
        'image',
        'total_price',
        'group_code',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }

    // Scope to get orders by group
    public function scopeByGroup($query, $groupCode)
    {
        return $query->where('group_code', $groupCode);
    }

    // Get total for a group of orders
    public static function getGroupTotal($groupCode)
    {
        return self::where('group_code', $groupCode)->sum('total_price');
    }

    // Get count for a group of orders
    public static function getGroupCount($groupCode)
    {
        return self::where('group_code', $groupCode)->count();
    }
}
