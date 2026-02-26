<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'modulo_id',
        'titulo',
        'tipo',
        'url_contenido',
        'fecha_programada',
    ];

    protected $casts = [
        'fecha_programada' => 'datetime',
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function obtenerCursoAtributo()
    {
        return $this->modulo->curso;
    }
}
