<?php
namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Leccion;
use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    public function run(): void
    {
        $cursos = Curso::all();

        foreach ($cursos as $curso) {
            // Se crean entre 4 y 8 módulos por curso
            $modulos = Modulo::factory(rand(4, 8))->for($curso)->create();

            $orden = 1;
            foreach ($modulos as $modulo) {
                $modulo->orden = $orden++;
                $modulo->save();

                // Se crean entre 5 y 12 lecciones por módulo
                Leccion::factory(rand(5, 12))->for($modulo)->create();
            }
        }
    }
}