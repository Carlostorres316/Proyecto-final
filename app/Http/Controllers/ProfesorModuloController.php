<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;
use App\Models\Modulo;
use Illuminate\Http\Request;

class ProfesorModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Curso $curso)
    {   
        // Verificar que el curso pertenece al profesor autenticado
        Curso::where('id', $curso->id)->where('user_id', Auth::id())->firstOrFail();

        //Traer los módulos del curso junto con sus lecciones para mostrarlos en la vista.
        $modulos = $curso->modulos()->with('lecciones')->get();

        return view('profesor.modulos.index')->with('modulos', $modulos)->with('curso', $curso);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Curso $curso)
    {   
        Curso::where('id', $curso->id)->where('user_id', Auth::id())->firstOrFail();

        return view('profesor.modulos.crear_modulo')->with('curso', $curso);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Curso $curso)
    {   
        Curso::where('id', $curso->id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'orden' => 'integer|nullable',
        ]);

        Modulo::create([
            'curso_id' => $curso->id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden,
        ]);

        return redirect()->route('profesor.modulos.index', $curso)->with('success', 'Módulo creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso, Modulo $modulo)
    {
        Curso::where('id', $curso->id)->where('user_id', Auth::id())->firstOrFail();

        return view('profesor.modulos.ver_modulo')->with('modulo', $modulo)->with('curso', $curso);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso, Modulo $modulo)
    {   
        Curso::where('id', $curso->id)->where('user_id', Auth::id())->firstOrFail();

        return view('profesor.modulos.editar_modulo')->with('modulo', $modulo)->with('curso', $curso);
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Curso $curso, Modulo $modulo)
    {   
        Curso::where('id', $curso->id)->where('user_id', Auth::id())->firstOrFail();
        
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'orden' => 'integer|nullable',
        ]);

        $modulo->update($request->all());

        return redirect()->route('profesor.modulos.index', $curso)->with('success', 'Modulo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso, Modulo $modulo)
    {   
        Curso::where('id', $curso->id)->where('user_id', Auth::id())->firstOrFail();

        $modulo->delete();

        return redirect()->route('profesor.modulos.index', $curso)->with('success', 'Modulo eliminado exitosamente');
    }
}