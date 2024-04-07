<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'user_id',
        'quantity',
        'image',
        'price',
    ];

    // Define relationships if needed
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function items()
    {
        return $this->hasMany(Menu::class);
    }
}
