<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subcategoria_id',
        'titulo',
        'descripcion',
        'precio',
        'nivel',
        'fecha_creacion',
    ];

    protected $casts = [
        'fecha_creacion' => 'datetime',
        'precio' => 'decimal:2',
    ];

    //Relaciones con otros modelos
    public function profesor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategorias::class);
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
