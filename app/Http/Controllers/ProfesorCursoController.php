<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Categorias;
use App\Models\Subcategorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesorCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        //Aca muestro solo los cursos que pertenecen al profesor autenticado usando el user_id para filtrar los cursos.
        $cursos = Curso::where('user_id', Auth::id())->get();

        return view('profesor.cursos.index')->with('cursos', $cursos);
    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function create()
    {   
        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        
        return view('profesor.cursos.crear_curso')->with('categorias', $categorias)->with('subcategorias', $subcategorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        //Profesor aca lo que se hace aca es validar la informcaion ademas de ver si es gratis o no.
        $reglas = [ 
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'tipo_precio' => 'required|in:gratis,pago',
        ];

        if ($request->tipo_precio === 'pago') {
            $reglas['precio'] = 'required|numeric|min:0.01';
        }

        $request->validate($reglas); 

        // Si el tipo de precio es pago, se asigna el valor del precio, si es gratis se asigna 0.
        $precio = $request->tipo_precio === 'pago' ? $request->precio : 0;

        Curso::create([
            'user_id' => Auth::id(),
            'subcategoria_id' => $request->subcategoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'precio' => $precio,
            'nivel' => $request->nivel,
            'fecha_creacion' => now(),
        ]);

        return redirect()->route('profesor.cursos.index')->with('Alamacenado','Curso creado exitosamente'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        //Aca muestro solo el curso que pertenece al profesor el firstOrFail para asegurarnos de que el curso existe sino lanzará una 404
        $cursos=Curso::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('profesor.cursos.ver_curso')->with('curso', $cursos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        //Aca muestro solo el curso que pertenece al profesor para que pueda editarlo
        $cursos= Curso::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        return view('profesor.cursos.editar_curso')->with('curso', $cursos)->with('categorias', $categorias)->with('subcategorias', $subcategorias);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        //Aca se actualiza solo el curso que pertenece al profesor para que pueda editarlo y se valida la informacion antes de actualizarla.
        $cursos = Curso::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'nullable|numeric|min:0',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
            'subcategoria_id' => 'required|exists:subcategorias,id',
        ]);

        $cursos->update($request->all());

        return redirect()->route('profesor.cursos.index')->with('Creado','Curso actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        //Aca se elimina solo el curso que pertenece al profesor para que pueda eliminarlo y se valida que el curso exista antes de eliminarlo.
        $cursos = Curso::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $cursos->delete();

        return redirect()->route('profesor.cursos.index')->with('Curso eliminado exitosamente');
    }

    public function estudiantes($id)
    {
        $curso = Curso::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $compras = $curso->compras()->with('estudiante')->get();

        return view('profesor.cursos.estudiantes')->with('curso', $curso)>with('compras', $compras);
    }
}
