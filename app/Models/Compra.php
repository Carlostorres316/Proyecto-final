<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'curso_id',
        'precio_pagado',
        'metodo_pago',
        'estado_pago',
    ];

    //Relaciones
    protected $casts = [
        'precio_pagado' => 'decimal:2',
    ];

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

}
