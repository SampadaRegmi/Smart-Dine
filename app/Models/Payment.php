<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'checkout_id', 'user_id', 'amount', 'request', 'response', 'payment_status'];

    public function checkout()
    {
        return $this->belongsTo(checkout::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
