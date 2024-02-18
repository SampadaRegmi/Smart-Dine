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
        'name', 'keywords', 'status', 'popular', 'description', 'price', 'FoodCategory', 'CourseCategory', 'image',
    ];
    
}
