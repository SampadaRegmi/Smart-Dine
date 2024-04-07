<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log; // Import the Log facade

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_type',
        'sub_total',
        'discount',
        'total_amount',
        'order_details',
        'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function menuItems()
    {
        return $this->hasMany(Menu::class, 'id', 'menu_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->payment_status = 'pending';
        });
    }
}
