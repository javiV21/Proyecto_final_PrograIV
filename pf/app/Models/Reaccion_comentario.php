<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaccion_comentario extends Model
{
    protected $fillable = [
        'usuario_id',
        'comentario_id',
        'reaccion'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function comentario()
    {
        return $this->belongsTo(Comentario::class, 'comentario_id');
    }
}
