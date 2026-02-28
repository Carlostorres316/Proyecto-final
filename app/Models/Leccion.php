<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    // Profesor aqui el nombre de la tabla es lecciones, pero por alguna razon laravel no lo reconoce asi que tuve que especificarlo manualmente.
    protected $table = 'lecciones';

    protected $fillable = [
        'modulo_id',
        'titulo',
        'tipo',
        'contenido',
        'url_video',
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
