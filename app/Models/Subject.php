<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'grade_id',
    ];

    public function  grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function questions()
    {
        return $this->hasManyThrough(Question::class, Chapter::class);
    }
}
