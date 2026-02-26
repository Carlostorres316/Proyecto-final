<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'categoria_id',
        'descripcion',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
