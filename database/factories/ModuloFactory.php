<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\Modulo;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Modulo>
 */
class ModuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=Modulo::class;
    public function definition(): array
    {   
        return [
            'curso_id'=>Curso::inRandomOrder()->first()->id,
            'titulo'=>fake()->sentence(3),
            'descripcion'=>fake()->paragraph(2,true),
            'orden'=>fake()->numberBetween(1,10),
        ];
    }
}
