<?php

namespace App\Http\Controllers;
use App\Models\Curso;
use Illuminate\Http\Request;

class ProfesorCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $cursos = Curso::where('user_id', auth()->id)->get();
        return view('profesor.cursos')->with('cursos', $cursos);
    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function create()
    {
        return view('profesor.crear_curso');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
        ]);

        Curso::create([
            'user_id' => auth()->id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'nivel' => $request->nivel,
            'fecha_creacion' => now(),
        ]);

        return redirect()->route('profesor.cursos')->with('Alamacenado','Curso creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cursos= Curso::where('id', $id)->where('user_id', auth()->id)->firstOrFail();
        return view('profesor.editar_curso')->with('curso', $cursos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cursos = Curso::where('id', $id)->where('user_id', auth()->id)->firstOrFail();
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
        ]);

        $cursos->update($request->all());

        return redirect()->route('profesor.cursos')->with('Creado','Curso actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cursos = Curso::where('id', $id)->where('user_id', auth()->id)->firstOrFail();
        $cursos->delete();

        return redirect()->route('profesor.cursos')->with('Curso eliminado exitosamente');
    }
}
