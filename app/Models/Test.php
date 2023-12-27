<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'test_date',
        'expires_at',
        'duration',
        'exercise_only',
        'frequent_only',
        'subject_id',
        'num_of_questions',
        'user_id',
    ];
    public function  subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
