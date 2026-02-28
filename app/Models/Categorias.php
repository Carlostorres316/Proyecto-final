<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    //Relacion uno a muchos con subcategorias
    public function subcategorias()
    {
        return $this->hasMany(Subcategorias::class);
    }
}
