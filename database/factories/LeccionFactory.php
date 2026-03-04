<?php

namespace Database\Factories;

use App\Models\Modulo;
use App\Models\Leccion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leccion>
 */
class LeccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Leccion::class;

    public function definition(): array
    {   
        return [
            'modulo_id'=>Modulo::inRandomOrder()->first()->id,
            'titulo'=>fake()->sentence(4),
            'tipo'=>fake()->randomElement(['material','video','pregunta']),
            'contenido'=>fake()->paragraph(3,true),
            'url_video'=>fake()->optional()->url(),
        ];
    }
}
