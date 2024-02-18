<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // Define the table associated with the model
    protected $table = 'feedbacks';

    // Define the fillable attributes for mass assignment
    protected $fillable = ['name', 'email', 'comment'];

    // Additional model logic, relationships, etc., can be added here
}
