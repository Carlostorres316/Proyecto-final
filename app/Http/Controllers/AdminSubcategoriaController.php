<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Subcategorias;
use Illuminate\Http\Request;

class AdminSubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Categorias $categoria)
    {
        $subcategorias = $categoria->subcategorias()->with('cursos')->get();
        return view('admin.subcategorias.index')->with('categoria',$categoria)->with('subcategorias',$subcategorias);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Categorias $categoria)
    {
            return view('admin.subcategorias.crear_subcategoria')->with('categoria', $categoria);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,Categorias $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria->subcategorias()->create(['nombre' => $request->nombre,'descripcion' => $request->descripcion,]);

        return redirect()->route('admin.subcategorias.index', $categoria->id)->with('success', 'Subcategoría creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($categoria_id, $subcategoria_id)   
    {
        $categoria = Categorias::findOrFail($categoria_id);

        $subcategoria = Subcategorias::with('cursos.profesor')->findOrFail($subcategoria_id);

        // Verificar que la subcategoría pertenezca a la categoría
        if ($subcategoria->categoria_id !== $categoria->id) {
            echo "La subcateogira es diferente a la categoria";
            abort(404);
        }

        return view('admin.subcategorias.ver_subcategoria')->with('categoria', $categoria)->with('subcategoria', $subcategoria);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorias $categoria, Subcategorias $subcategoria)
    {
        if ($subcategoria->categoria_id !== $categoria->id) {
            echo "La subcateogira es diferente a la categoria";
            abort(404);
        }

        return view('admin.subcategorias.editar_subcategoria')->with('categoria', $categoria)->with('subcategoria', $subcategoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorias $categoria, Subcategorias $subcategoria)
    {
        if ($subcategoria->categoria_id !== $categoria->id) {
            echo "La subcateogira es diferente a la categoria";
            abort(404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $subcategoria->update($request->only('nombre', 'descripcion'));

        return redirect()->route('admin.subcategorias.index', $categoria->id)->with('success', 'Subcategoría actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorias $categoria, Subcategorias $subcategoria)
    {
        if ($subcategoria->categoria_id !== $categoria->id) {
            echo "La subcateogira es diferente a la categoria";
            abort(404);
        }
        // Verificar si tiene cursos
        // cursos() , aqui se utiliza la relacion para consultar en la base de datos su equivalente seria 
        // $cursos = Curso::where('subcategoria_id', $id)->get(); $cursos->count();
        
        if ($subcategoria->cursos()->count() > 0) {
            return redirect()->route('admin.subcategorias.index', $categoria->id)->with('error', 'No se puede eliminar una subcategoría que tiene cursos asociados');
        }

        $subcategoria->delete();

        return redirect()->route('admin.subcategorias.index', $categoria->id)->with('success', 'Subcategoría eliminada exitosamente');
    }
}
