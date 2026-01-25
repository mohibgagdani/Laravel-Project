<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookIssue extends Model
{
    protected $fillable = ['user_id', 'book_id', 'issue_date', 'due_date', 'return_date', 'fine', 'status'];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function calculateFine()
    {
        if ($this->status === 'returned' && $this->return_date) {
            $daysLate = $this->return_date->diffInDays($this->due_date, false);
            return $daysLate < 0 ? abs($daysLate) * 5 : 0;
        }
        
        if ($this->status === 'issued' && Carbon::now()->gt($this->due_date)) {
            $daysLate = Carbon::now()->diffInDays($this->due_date, false);
            return abs($daysLate) * 5;
        }
        
        return 0;
    }
}
