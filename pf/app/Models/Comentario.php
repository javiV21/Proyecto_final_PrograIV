<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'usuario_id',
        'historia_id',
        'contenido'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function historia()
    {
        return $this->belongsTo(Historia::class, 'historia_id');
    }

    public function reacciones_comentario()
    {
        return $this->hasMany(Reaccion_comentario::class);
    }
}
