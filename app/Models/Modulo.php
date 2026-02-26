<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'titulo',
        'descripcion',
        'orden',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function lecciones()
    {
        return $this->hasMany(Leccion::class);
    }

}
