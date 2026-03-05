<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategorias;
use App\Models\Categorias;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenemos todas las categorías
        $categorias = Categorias::all()->keyBy('nombre');

        // 1. Desarrollo de Software
        if ($categorias->has('Desarrollo de Software')) {
            $desarrolloSubcategorias = [
                [
                    'categoria_id' => $categorias['Desarrollo de Software']->id,
                    'nombre' => 'Desarrollo Web',
                    'descripcion' => 'Desarrollo web con HTML, CSS, JavaScript, React, Angular, Vue, Node.js'
                ],
                [
                    'categoria_id' => $categorias['Desarrollo de Software']->id,
                    'nombre' => 'Desarrollo Móvil',
                    'descripcion' => 'Desarrollo de aplicaciones móviles para iOS, Android, Flutter, React Native'
                ],
                [
                    'categoria_id' => $categorias['Desarrollo de Software']->id,
                    'nombre' => 'Lenguajes de Programación',
                    'descripcion' => 'Python, Java, C++, C#, PHP, Ruby, Go, Rust, Swift'
                ],
                [
                    'categoria_id' => $categorias['Desarrollo de Software']->id,
                    'nombre' => 'Desarrollo de Videojuegos',
                    'descripcion' => 'Desarrollo de videojuegos con Unity, Unreal Engine, Godot'
                ],
                [
                    'categoria_id' => $categorias['Desarrollo de Software']->id,
                    'nombre' => 'Diseño de Bases de Datos',
                    'descripcion' => 'SQL, MySQL, PostgreSQL, MongoDB, Oracle, Diseño de bases de datos'
                ],
                [
                    'categoria_id' => $categorias['Desarrollo de Software']->id,
                    'nombre' => 'Pruebas de Software',
                    'descripcion' => 'Pruebas de software, automatización, control de calidad, Selenium'
                ],
            ];

            foreach ($desarrolloSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }

        // 2. Negocios
        if ($categorias->has('Negocios')) {
            $negociosSubcategorias = [
                [
                    'categoria_id' => $categorias['Negocios']->id,
                    'nombre' => 'Emprendimiento',
                    'descripcion' => 'Emprendimiento, startups, modelos de negocio'
                ],
                [
                    'categoria_id' => $categorias['Negocios']->id,
                    'nombre' => 'Gestión Empresarial',
                    'descripcion' => 'Gestión empresarial, liderazgo, administración'
                ],
                [
                    'categoria_id' => $categorias['Negocios']->id,
                    'nombre' => 'Ventas',
                    'descripcion' => 'Ventas, técnicas de venta, negociación'
                ],
                [
                    'categoria_id' => $categorias['Negocios']->id,
                    'nombre' => 'Estrategia Empresarial',
                    'descripcion' => 'Estrategia empresarial, planificación, crecimiento'
                ],
                [
                    'categoria_id' => $categorias['Negocios']->id,
                    'nombre' => 'Operaciones y Logística',
                    'descripcion' => 'Operaciones, logística, cadena de suministro'
                ],
                [
                    'categoria_id' => $categorias['Negocios']->id,
                    'nombre' => 'Proyectos y Metodologías Ágiles',
                    'descripcion' => 'Gestión de proyectos, PMP, Agile, Scrum'
                ],
            ];

            foreach ($negociosSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }

        // 3. Finanzas e Inversiones
        if ($categorias->has('Finanzas e Inversiones')) {
            $finanzasSubcategorias = [
                [
                    'categoria_id' => $categorias['Finanzas e Inversiones']->id,
                    'nombre' => 'Contabilidad',
                    'descripcion' => 'Contabilidad, libros contables, balances'
                ],
                [
                    'categoria_id' => $categorias['Finanzas e Inversiones']->id,
                    'nombre' => 'Criptomonedas',
                    'descripcion' => 'Criptomonedas, blockchain, trading'
                ],
                [
                    'categoria_id' => $categorias['Finanzas e Inversiones']->id,
                    'nombre' => 'Finanzas Corporativas',
                    'descripcion' => 'Finanzas corporativas, análisis financiero'
                ],
                [
                    'categoria_id' => $categorias['Finanzas e Inversiones']->id,
                    'nombre' => 'Inversiones',
                    'descripcion' => 'Inversiones, bolsa, trading, análisis técnico'
                ],
                [
                    'categoria_id' => $categorias['Finanzas e Inversiones']->id,
                    'nombre' => 'Impuestos',
                    'descripcion' => 'Impuestos, declaraciones, planificación fiscal'
                ],
            ];

            foreach ($finanzasSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }

        // 4. IT & Software
        if ($categorias->has('It & Software')) { 
            $itSubcategorias = [
                [
                    'categoria_id' => $categorias['It & Software']->id,
                    'nombre' => 'Redes y Seguridad Informática',
                    'descripcion' => 'Redes, seguridad informática, Cisco, firewall'
                ],
                [
                    'categoria_id' => $categorias['It & Software']->id,
                    'nombre' => 'Hardware',
                    'descripcion' => 'Hardware, mantenimiento, ensamblaje'
                ],
                [
                    'categoria_id' => $categorias['It & Software']->id,
                    'nombre' => 'Sistemas Operativos',
                    'descripcion' => 'Sistemas operativos, Windows, Linux, macOS'
                ],
                [
                    'categoria_id' => $categorias['It & Software']->id,
                    'nombre' => 'Cloud Computing',
                    'descripcion' => 'Computación en la nube, AWS, Azure, Google Cloud'
                ],
            ];

            foreach ($itSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }

        // 5. Cursos de Productividad 
        if ($categorias->has('Cursos de Productividad')) {
            $productividadSubcategorias = [
                [
                    'categoria_id' => $categorias['Cursos de Productividad']->id,
                    'nombre' => 'Microsoft Excel',
                    'descripcion' => 'Excel, hojas de cálculo, fórmulas, macros'
                ],
                [
                    'categoria_id' => $categorias['Cursos de Productividad']->id,
                    'nombre' => 'Microsoft Word',
                    'descripcion' => 'Word, procesamiento de textos, documentos'
                ],
                [
                    'categoria_id' => $categorias['Cursos de Productividad']->id,
                    'nombre' => 'Microsoft PowerPoint',
                    'descripcion' => 'PowerPoint, presentaciones, diseño de diapositivas'
                ],
                [
                    'categoria_id' => $categorias['Cursos de Productividad']->id,
                    'nombre' => 'Google Workspace',
                    'descripcion' => 'Google Workspace, Gmail, Drive, Docs'
                ],
                [
                    'categoria_id' => $categorias['Cursos de Productividad']->id,
                    'nombre' => 'Apple iWork',
                    'descripcion' => 'Pages, Numbers, Keynote'
                ],
            ];

            foreach ($productividadSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }

        // 6. Desarrollo Personal
        if ($categorias->has('Desarrollo Personal')) {
            $personalSubcategorias = [
                [
                    'categoria_id' => $categorias['Desarrollo Personal']->id,
                    'nombre' => 'Liderazgo',
                    'descripcion' => 'Liderazgo, habilidades directivas'
                ],
                [
                    'categoria_id' => $categorias['Desarrollo Personal']->id,
                    'nombre' => 'Productividad Personal',
                    'descripcion' => 'Productividad personal, gestión del tiempo'
                ],
                [
                    'categoria_id' => $categorias['Desarrollo Personal']->id,
                    'nombre' => 'Comunicación',
                    'descripcion' => 'Comunicación, oratoria, habilidades sociales'
                ],
                [
                    'categoria_id' => $categorias['Desarrollo Personal']->id,
                    'nombre' => 'Manejo del Estrés y Mindfulness',
                    'descripcion' => 'Manejo del estrés, mindfulness, meditación'
                ],
            ];

            foreach ($personalSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }

        // 7. Diseño
        if ($categorias->has('Diseño')) {
            $disenoSubcategorias = [
                [
                    'categoria_id' => $categorias['Diseño']->id,
                    'nombre' => 'Diseño Gráfico',
                    'descripcion' => 'Diseño gráfico, Photoshop, Illustrator, Canva'
                ],
                [
                    'categoria_id' => $categorias['Diseño']->id,
                    'nombre' => 'UI/UX Diseño',
                    'descripcion' => 'Diseño de interfaces, experiencia de usuario, Figma'
                ],
                [
                    'categoria_id' => $categorias['Diseño']->id,
                    'nombre' => 'Diseño Web',
                    'descripcion' => 'Diseño web, responsive diseño, WordPress'
                ],
                [
                    'categoria_id' => $categorias['Diseño']->id,
                    'nombre' => 'Diseño 3D',
                    'descripcion' => 'Diseño 3D, Blender, Maya, 3ds Max'
                ],
                [
                    'categoria_id' => $categorias['Diseño']->id,
                    'nombre' => 'Animación',
                    'descripcion' => 'Animación, After Effects, animación 2D/3D'
                ],
                [
                    'categoria_id' => $categorias['Diseño']->id,
                    'nombre' => 'Diseño de Moda',
                    'descripcion' => 'Diseño de moda, patronaje, costura'
                ],
            ];

            foreach ($disenoSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }

        // 8. Marketing
        if ($categorias->has('Marketing')) {
            $marketingSubcategorias = [
                [
                    'categoria_id' => $categorias['Marketing']->id,
                    'nombre' => 'Marketing Digital',
                    'descripcion' => 'Marketing digital, estrategias online'
                ],
                [
                    'categoria_id' => $categorias['Marketing']->id,
                    'nombre' => 'Redes Sociales',
                    'descripcion' => 'Redes sociales, community management'
                ],
                [
                    'categoria_id' => $categorias['Marketing']->id,
                    'nombre' => 'Analítica Web',
                    'descripcion' => 'Analítica web, Google Analytics, métricas'
                ],
                [
                    'categoria_id' => $categorias['Marketing']->id,
                    'nombre' => 'SEO y SEM',
                    'descripcion' => 'Posicionamiento en buscadores, Google Ads'
                ],
            ];

            foreach ($marketingSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }

        // 9. Salud y Bienestar
        if ($categorias->has('Salud y Bienestar')) {
            $saludSubcategorias = [
                [
                    'categoria_id' => $categorias['Salud y Bienestar']->id,
                    'nombre' => 'Ejercicio y Fitness',
                    'descripcion' => 'Ejercicio, entrenamiento, gimnasio'
                ],
                [
                    'categoria_id' => $categorias['Salud y Bienestar']->id,
                    'nombre' => 'Nutrición',
                    'descripcion' => 'Nutrición, dietas, alimentación saludable'
                ],
                [
                    'categoria_id' => $categorias['Salud y Bienestar']->id,
                    'nombre' => 'Yoga',
                    'descripcion' => 'Yoga, meditación, bienestar'
                ],
                [
                    'categoria_id' => $categorias['Salud y Bienestar']->id,
                    'nombre' => 'Salud Mental',
                    'descripcion' => 'Salud mental, psicología, bienestar emocional'
                ],
                [
                    'categoria_id' => $categorias['Salud y Bienestar']->id,
                    'nombre' => 'Deportes',
                    'descripcion' => 'Deportes, entrenamiento deportivo'
                ],
                [
                    'categoria_id' => $categorias['Salud y Bienestar']->id,
                    'nombre' => 'Primeros Auxilios y Seguridad',
                    'descripcion' => 'Primeros auxilios, RCP, seguridad'
                ],
            ];

            foreach ($saludSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }

        // 10. Musica y Producción
        if ($categorias->has('Musica y Producción')) {
            $musicaSubcategorias = [
                [
                    'categoria_id' => $categorias['Musica y Producción']->id,
                    'nombre' => 'Producción Musical',
                    'descripcion' => 'Producción musical, Ableton, FL Studio'
                ],
                [
                    'categoria_id' => $categorias['Musica y Producción']->id,
                    'nombre' => 'Guitarra',
                    'descripcion' => 'Guitarra acústica, eléctrica, española'
                ],
                [
                    'categoria_id' => $categorias['Musica y Producción']->id,
                    'nombre' => 'Piano',
                    'descripcion' => 'Piano, teclado, teoría musical'
                ],
                [
                    'categoria_id' => $categorias['Musica y Producción']->id,
                    'nombre' => 'Voz',
                    'descripcion' => 'Canto, técnica vocal, interpretación'
                ],
                [
                    'categoria_id' => $categorias['Musica y Producción']->id,
                    'nombre' => 'Teoría Musical',
                    'descripcion' => 'Teoría musical, armonía, composición'
                ],
                [
                    'categoria_id' => $categorias['Musica y Producción']->id,
                    'nombre' => 'Batería',
                    'descripcion' => 'Batería, percusión, ritmos'
                ],
                [
                    'categoria_id' => $categorias['Musica y Producción']->id,
                    'nombre' => 'Bajo Eléctrico',
                    'descripcion' => 'Bajo eléctrico, técnicas, grooves'
                ],
            ];

            foreach ($musicaSubcategorias as $subcategoria) {
                Subcategorias::create($subcategoria);
            }
        }
    }
}