<?php

namespace Database\Factories;
use App\Models\Subcategorias;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=Curso::class;
    
    public function definition(): array
    {
        return [
            'user_id'=>User::where('rol','profesor')->inRandomOrder()->first()->id,
            'subcategoria_id'=>Subcategorias::inRandomOrder()->first()->id,
            'titulo'=>fake()->sentence(4),
            'descripcion'=>fake()->paragraph(3,true),
            'precio'=>fake()->randomFloat(2,0,199),
            'nivel'=>fake()->randomElement(['principiante','intermedio','avanzado']),
            'fecha_creacion'=>fake()->dateTimeBetween('-1 year','now'),
        ];
    }
}
