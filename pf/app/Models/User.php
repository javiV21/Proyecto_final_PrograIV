<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'username',
        'edad',
        'email',
        'password',
    ];

    public function historia()
    {
        return $this->hasMany(Historia::class, 'usuario_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function reacciones_historia()
    {
        return $this->hasMany(Reaccion_historia::class);
    }

    public function reacciones_comentario()
    {
        return $this->hasMany(Reaccion_comentario::class);
    }
    public function setPasswordAttribute($value)
    {
        // Si ya es un hash, lo deja; si no, lo bcrypt
        $this->attributes['password'] = \Illuminate\Support\Str::startsWith($value, '$2y$')
            ? $value
            : bcrypt($value);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
