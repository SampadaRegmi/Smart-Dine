<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'order_type',
        'payment_status',
        'payment_method',
        'to_pay',
    ];

    public function products()
    {
        return $this->hasMany(CheckoutProduct::class);
    }
}
