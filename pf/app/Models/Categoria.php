<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre'];

    public function historias()
    {
        return $this->hasMany(Historia::class);
    }
}
