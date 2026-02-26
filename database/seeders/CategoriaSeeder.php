<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorias;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Desarrollo de Software',
                'descripcion' => 'Cursos de desarrollo de software y programación'
            ],
            [
                'nombre' => 'Negocios',
                'descripcion' => 'Cursos de negocios, emprendimiento y gestión empresarial'
            ],
            [
                'nombre' => 'Finanzas e Inversiones',
                'descripcion' => 'Cursos de finanzas, contabilidad e inversiones'
            ],
            [
                'nombre' => 'It & Software',
                'descripcion' => 'Cursos de tecnología de la información y software'
            ],
            [
                'nombre' => 'Cursos de Productividad',
                'descripcion' => 'Cursos de productividad con herramientas ofimáticas'
            ],
            [
                'nombre' => 'Desarrollo Personal',
                'descripcion' => 'Cursos de desarrollo personal y profesional'
            ],
            [
                'nombre' => 'Diseño',
                'descripcion' => 'Cursos de diseño gráfico, UX/UI y herramientas creativas'
            ],
            [
                'nombre' => 'Marketing',
                'descripcion' => 'Cursos de marketing digital, SEO y redes sociales'
            ],
            [
                'nombre' => 'Salud y Bienestar',
                'descripcion' => 'Cursos de salud, fitness, nutrición y bienestar'
            ],
            [
                'nombre' => 'Musica y Producción',
                'descripcion' => 'Cursos de música, producción musical e instrumentos'
            ],
        ];

        //Recorremos el array de categorías y las creamos en la base de datos
        foreach ($categorias as $categoria) {
            Categorias::create($categoria);
        }
    }
}