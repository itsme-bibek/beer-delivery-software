<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_group_code',
        'invoice_number',
        'subtotal',
        'tax',
        'discount',
        'total',
        'billing_name',
        'billing_address',
        'billing_email',
        'billing_phone',
        'issued_at',
        'period_start',
        'period_end',
        'type', // single | monthly
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'period_start' => 'datetime',
        'period_end' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'group_code', 'order_group_code');
    }
}


