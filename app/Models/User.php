<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes, HasFactory;


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->loans()->exists()) return throw new Exception('Usuário possui livros não devolvido e não pode ser deletado.');
        });
    }

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'registration_number',
    ];

    protected $casts = [
        'registration_number' => 'integer',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
