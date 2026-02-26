<?php
namespace App\Http\Controllers;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Leccion;
use Illuminate\Http\Request;

class ProfesorLeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Modulo $modulos)
    {
        $lecciones = $modulos->lecciones;
        return view('profesor.lecciones.index')->with('lecciones', $lecciones);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Modulo $modulos)
    {
        return view('profesor.lecciones.crear_leccion')->with('modulos', $modulos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Modulo $modulos)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo'=>'required|in:video,texto,quiz',
            'url_contenido' => 'nullable|string',
            'fecha_programada' => 'required|date',
        ]);

        Leccion::create([
            'modulo_id' => $modulos->id,
            'titulo' => $request->titulo,
            'tipo' => $request->tipo,
            'url_contenido' => $request->url_contenido,
            'fecha_programada' => $request->fecha_programada,
        ]);

        return redirect()->route('profesor.cursos.lecciones', $modulos)->with('Alamacenado','Lección creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lecciones = Leccion::findOrFail($id);
        return view('profesor.lecciones.ver_leccion')->with('leccion', $lecciones);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Modulo $modulos, Leccion $lecciones)
    {
        return view('profesor.lecciones.editar_leccion')->with('leccion', $lecciones)->with('modulos', $modulos);
    }
  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,Modulo $modulos, Leccion $lecciones)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo'=>'required|in:video,texto,quiz',
            'url_contenido' => 'nullable|string',
            'fecha_programada' => 'required|date',
        ]);

        $lecciones->update($request->all());

        return redirect()->route('profesor.lecciones', $modulos)->with('Creado','Lección actualizada exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Modulo $modulos, Leccion $lecciones)
    {
        $lecciones->delete();
        return redirect()->route('profesor.lecciones', $modulos)->with('Eliminado','Lección eliminada exitosamente');
    }
}
