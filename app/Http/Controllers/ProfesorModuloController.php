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
    public function index(Curso $cursos)
    {   
        Curso::where('id', $cursos->id)->where('user_id', Auth::id())->firstOrFail();

        $modulos = $cursos->modulos()->orderBy('orden')->get();
        return view('profesor.modulos.index')->with('modulos', $modulos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Curso $cursos)
    {   
        Curso::where('id', $cursos->id)->where('user_id', Auth::id())->firstOrFail();
        return view('profesor.modulos.crear_modulo')->with('cursos', $cursos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Curso $cursos)
    {   
        Curso::where('id', $cursos->id)->where('user_id', Auth::id())->firstOrFail();
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'orden' => 'integer|nullable',
        ]);

        Modulo::create([
            'curso_id' => $cursos->curso_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden,
        ]);

        return redirect()->route('profesor.modulos', $cursos)->with('Alamacenado','Modulo creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,Curso $cursos, Modulo $modulos)
    {
        Curso::where('id', $cursos->id)->where('user_id', Auth::id())->firstOrFail();
        return view('profesor.modulos.ver_modulo')->with('modulo', $modulos)->with('cursos', $cursos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,curso $cursos, Modulo $modulos)
    {   
        Curso::where('id', $cursos->id)->where('user_id', Auth::id())->firstOrFail();
        return view('profesor.modulos.editar_modulo')->with('modulo', $modulos)->with('cursos', $cursos);
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,curso $cursos, Modulo $modulos)
    {   
        Curso::where('id', $cursos->id)->where('user_id', Auth::id())->firstOrFail();
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'orden' => 'integer|nullable',
        ]);

        $modulos->update($request->all());

        return redirect()->route('profesor.modulos', $cursos)->with('Creado','Modulo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id ,curso $cursos, Modulo $modulos)
    {   
        Curso::where('id', $cursos->id)->where('user_id', Auth::id())->firstOrFail();
        $modulos->delete();
        return redirect()->route('profesor.modulos', $cursos)->with('Eliminado','Modulo eliminado exitosamente');
    }
}
