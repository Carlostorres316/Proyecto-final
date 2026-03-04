<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Subcategorias;
use Illuminate\Http\Request;

class AdminCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categorias::with('subcategorias')->get();
        return view('admin.categorias.index')->with('categorias', $categorias);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.crear_categoria');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Categorias::create($request->all());

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categorias::with('subcategorias')->findOrFail($id);
        return view('admin.categorias.ver_categoria')->with('categoria', $categoria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categorias::findOrFail($id);
        return view('admin.categorias.editar_categoria')->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria = Categorias::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria->update($request->all());

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categorias::findOrFail($id);
        
        // Verificar si tiene subcategorías
        if ($categoria->subcategorias()->count() > 0) {
            return redirect()->route('admin.categorias.index')->with('error', 'No se puede eliminar una categoría que tiene subcategorías');
        }

        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada exitosamente');
    }
}