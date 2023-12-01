<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssuance extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'copy_no',
        'reader_id',
        'issue_date',
        'due_date',
        'return_date',
        'book_status', //return book status
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function reader()
    {
        return $this->belongsTo(Student::class);
    }
    public function scopePending($query)
    {
        return $query->whereNull('return_date')->where('due_date', '<', today());
    }
    public function latency()
    {
        //difference in days
        if (now() > Carbon::parse($this->due_date)) {
            // due date passed
            return now()->diffInDays(Carbon::parse($this->due_date));
        } else {
            return '';
        }
    }
    public function fine()
    {
        $fine = 0;
        $finePerDay = BookReturnPolicy::first()->fine_per_day;
        if ($this->latency() > 0) {
            $fine = $this->latency() * $finePerDay;
        }
        return $fine;
    }
    public function scopeInPossession($query)
    {
        return $query->whereNull('return_date');
    }
    public function returned($query)
    {
        return $query->whereNotNull('return_date');
    }
    public function scopeIssued($query)
    {
        return $query->whereNull('return_date');
    }
}
