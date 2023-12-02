<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReturnPolicy extends Model
{
    use HasFactory;
    protected $fillable = [
        'max_days',
        'fine_per_day',
    ];
}
