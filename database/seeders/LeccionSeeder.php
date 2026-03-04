<?php

namespace Database\Seeders;

use App\Models\Modulo;
use App\Models\Leccion;
use Illuminate\Database\Seeder;

class LeccionSeeder extends Seeder
{
    public function run(): void
    {
        $modulos = Modulo::all();

        foreach ($modulos as $modulo) {
            // Se crean entre 5 y 12 lecciones por módulo
            Leccion::factory(rand(5, 12))->for($modulo)->create();
        }
    }
}
