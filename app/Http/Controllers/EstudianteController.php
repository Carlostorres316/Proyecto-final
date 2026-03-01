<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Leccion;
use App\Models\Compra;
use Illuminate\Support\Facades\Redirect;

class EstudianteController extends Controller
{   
    public function dashboard()
    {
        //Profesor aqui utilize un pequeño artificio para obtener los cursos comprados por el estudiante, ya que no tengo una relación directa entre User y Curso como estudiante, sino a través de la tabla intermedia Compra.
        //Tambien el Visual Studio Code me daba error en Auth::user()->comprasEstudiante() porque no reconocia el método comprasEstudiante() 
        //que es una relación definida en el modelo User, pero al agregar el  /** @var \App\Models\User $user */ antes de la asignación de $user, le indico a Visual Studio Code que la variable $user es una instancia del modelo User
        //espero que se entienda.
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $cursos = $user->comprasEstudiante()->with('curso')->get();

        return view('estudiante.dashboard')->with('cursos', $cursos);   
    }

    
    public function catalogo()
    {
        $cursos = Curso::with('profesor')->get();
        return view('estudiante.catalogo')->with('cursos', $cursos);
    }

    public function misCursos()
    {   
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $cursos = $user->comprasEstudiante()->with('curso')->get();

        return view('estudiante.mis_cursos')->with('cursos', $cursos);
    }

    public function comprarCurso(Request $request, $cursoId)
    {
        $curso = Curso::findOrFail($cursoId);
        //Ver si el curso es gratis,si es asi lo compra directamnte sino pasa por el poroceso de compra normal.
        if ($curso->precio == 0) {

            Compra::create([
                'user_id' => Auth::id(),
                'curso_id' => $curso->id,
                'precio_pagado' => 0,
                'metodo_pago' => 'gratis',
                'estado_pago' => 'completado',
        ]);
            return redirect()->route('estudiante.mis_cursos')->with('compra_exitosa', 'Te inscribiste al curso gratuito.');
        }

        $request->validate([
            'metodo_pago' => 'required|in:tarjeta,paypal,transferencia'
        ]);

        Compra::create([
            'user_id' => Auth::id(),
            'curso_id' => $curso->id,
            'precio_pagado' => $curso->precio,
            'metodo_pago' => $request->metodo_pago,
            'estado_pago' => 'completado',
        ]);

        return redirect()->route('estudiante.mis-cursos')->with('compra_exitosa', 'Curso comprado exitosamente');
    }

    public function verCurso($cursoId)
    {
        $curso = Curso::with(['modulos.lecciones', 'profesor'])->find($cursoId);
        return view('estudiante.ver_curso')->with('curso', $curso);
    }

    public function verModulo($cursoId, $moduloId)
    {
        $modulo = Modulo::with('lecciones')->find($moduloId);
        $curso = Curso::find($cursoId);

        return view('estudiante.ver_modulo')->with('modulo', $modulo)->with('curso', $curso);
    }

    public function verLeccion($cursoId, $moduloId, $leccionId)
    {
        $leccion = Leccion::findOrFail($leccionId);
        $modulo = Modulo::findOrFail($moduloId);
        $curso = Curso::findOrFail($cursoId);
        
        return view('estudiante.ver_leccion')->with('leccion', $leccion)->with('modulo', $modulo)->with('curso', $curso);
    }

    public function agregarCarrito($cursoId)
    {
        $curso = Curso::findOrFail($cursoId);
        
        // Verificar si ya compró el curso
         /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->comprasEstudiante()->where('curso_id', $cursoId)->exists()) {
            return redirect()->route('estudiante.cursos')->with('error', 'Ya tienes este curso');
        }
        
        // Obtener carrito de la sesión
        $carrito = session('carrito', []);
        
        // Verificar si ya está en el carrito
        if (in_array($cursoId, $carrito)) {
            return Redirect()->route('estudiante.cursos')->with('error', 'El curso ya está en el carrito');
        }
        
        // Agregar al carrito
        $carrito[] = $cursoId;
        session(['carrito' => $carrito]);
        
        return redirect()->route('estudiante.cursos')->with('carrito_agregado', 'Curso agregado al carrito');
    }

   public function quitarCarrito($cursoId)
    {
        $carrito = session('carrito', []);
        
        // Eliminar el curso del carrito
        foreach ($carrito as $indice => $id) {
            if ($id == $cursoId) {
                unset($carrito[$indice]);
                break;
            }
        }
        session(['carrito' => array_values($carrito)]);
        
        return redirect()->route('estudiante.carrito')->with('success', 'Curso eliminado');
    }

    public function procesarCompra(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required|in:tarjeta,paypal,transferencia'
        ]);
        
        $carrito = session()->get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('estudiante.carrito')->with('carrito_vacio', 'El carrito está vacío');
        }
        
        $cursos = Curso::whereIn('id', $carrito)->get();
        $comprasRealizadas = 0;
        
        foreach ($cursos as $curso) {
            // Verificar que no esté ya comprado
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $yaComprado = $user->comprasEstudiante()->where('curso_id', $curso->id)->exists();
            if (!$yaComprado) {
                Compra::create([
                    'user_id' => Auth::id(),
                    'curso_id' => $curso->id,
                    'precio_pagado' => $curso->precio,
                    'metodo_pago' => $request->metodo_pago,
                    'estado_pago' => 'completado',
                ]);
                $comprasRealizadas++;
            }
        }
        
        // Limpiar carrito después de procesar la compra
        session()->forget('carrito');
        
        return redirect()->route('estudiante.mis-cursos')->with('compra_exitosa', "Completaste la compra de $comprasRealizadas cursos");
    }

    public function vivo()
    {
        return view('estudiante.enVivo');
    }

     public function carrito()
    {
        return view('estudiante.carrito');
    }

    public function ordenDeCompra()
    {
        return view('estudiante.orden_de_compra');
    }
}
