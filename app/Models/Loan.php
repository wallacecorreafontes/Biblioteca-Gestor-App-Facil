<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loans';

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
    ];

    protected $casts = [
        'borrowed_at' => 'date',
        'due_date' => 'date',
        'returned_at' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($loan) {
            $book = $loan->book;
            if ($book && $book->status === 'available') {
                $book->update(['status' => 'borrowed']);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getFormattedBorrowedAtAttribute()
    {
        return $this->borrowed_at ? $this->borrowed_at->format('d/m/Y') : null;
    }

    public function getFormattedDueDateAttribute()
    {
        return $this->due_date ? $this->due_date->format('d/m/Y') : null;
    }

    public function status(): string
    {
        if ($this->returned_at) {
            return 'Devolvido em ' . $this->returned_at->format('d/m/Y');
        }

        if ($this->due_date && $this->due_date->lt(Carbon::today())) {
            return 'Em atraso';
        }

        return 'Emprestado';
    }

    public function markAsReturned()
    {
        if ($this->returned_at) {
            return;
        }

        $this->update([
            'returned_at' => now(),
        ]);

        if ($this->book && $this->book->status !== 'available') {
            $this->book->update(['status' => 'available']);
        }
    }
}
