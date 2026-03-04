<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\User;
use App\Models\Subcategorias;
use Illuminate\Http\Request;

class AdminCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::with(['profesor', 'subcategoria'])->get();
        return view('admin.cursos.index')->with('cursos', $cursos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profesores = User::where('rol', 'profesor')->get();
        $subcategorias = Subcategorias::all();
        
        return view('admin.cursos.crear_curso')->with('profesores', $profesores)->with('subcategorias', $subcategorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
        ]);

        Curso::create([
            'user_id' => $request->user_id,
            'subcategoria_id' => $request->subcategoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'nivel' => $request->nivel,
            'fecha_creacion' => now(),
        ]);

        return redirect()->route('admin.cursos.index')->with('success', 'Curso creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = Curso::with(['profesor', 'subcategoria', 'modulos.lecciones'])->findOrFail($id);
        return view('admin.cursos.ver_curso')->with('curso', $curso);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $curso = Curso::findOrFail($id);
        $profesores = User::where('rol', 'profesor')->get();
        $subcategorias = Subcategorias::all();
        
        return view('admin.cursos.editar_curso')
            ->with('curso', $curso)
            ->with('profesores', $profesores)
            ->with('subcategorias', $subcategorias);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $curso = Curso::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
        ]);

        $curso->update($request->all());

        return redirect()->route('admin.cursos.index')->with('success', 'Curso actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('admin.cursos.index')->with('success', 'Curso eliminado exitosamente');
    }
}