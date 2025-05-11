<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $fillable = [
        'usuario_id',
        'categoria_id',
        'titulo',
        'contenido'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function reacciones_historia()
    {
        return $this->hasMany(Reaccion_historia::class);
    }
}
