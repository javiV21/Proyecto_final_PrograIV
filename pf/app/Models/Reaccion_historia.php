<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaccion_historia extends Model
{
    protected $fillable = [
        'usuario_id',
        'historia_id',
        'reaccion'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function historia()
    {
        return $this->belongsTo(Historia::class);
    }
}
