<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'month',
        'capital',
        'total_user',
        'total_orders',
        'total_transaction',
        'profit_or_loss',
    ];
}
