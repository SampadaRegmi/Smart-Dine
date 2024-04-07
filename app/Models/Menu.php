<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public const FoodCategory = ['Veg', 'Non-veg'];
    public const CourseCategory = ['all','appetizers', 'drinks', 'dessert', 'entree', 'salads'];

    protected $fillable = [
        'name', 'keywords', 'description', 'price', 'FoodCategory', 'CourseCategory', 'image',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

}
