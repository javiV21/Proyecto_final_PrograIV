<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationToken extends Model
{
    // Como solo usamos `created_at`, desactivamos updated_at
    public $timestamps = false;

    // Definimos que la columna de timestamp es created_at
    const CREATED_AT = 'created_at';

    // Asignación masiva: user_id y token
    protected $fillable = ['user_id', 'token'];

    /**
     * Relación inversa hacia User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}