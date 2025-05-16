<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'registration_number',
        'status',
    ];

    protected $casts = [
        'registration_number' => 'integer',
        'status' => 'string',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }

    public function status()
    {
        return ($this->status === 'borrowed') ? 'Emprestado' : 'Disponível';
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
