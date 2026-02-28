<?php
namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Leccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesorLeccionController extends Controller
{
    public function create(Modulo $modulo)
    {
        // Verificar que el módulo pertenece a un curso del profesor
        $curso = $modulo->curso;
        if ($curso->user_id != Auth::id()) {
            echo "No tienes permiso para agregar lecciones a este modulo";
            abort(404);
        }
        
        return view('profesor.lecciones.crear_leccion')->with('modulo', $modulo);
    }

    public function store(Request $request, Modulo $modulo)
    {
        // Verificar que el módulo pertenece a un curso del profesor
        $curso = $modulo->curso;
        if ($curso->user_id != Auth::id()) {
            echo "No tienes permiso para agregar lecciones a este modulo";
            abort(403);
        }
        
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|in:material,pregunta,video',
            'contenido' => 'nullable|string',
            'url_video' => 'nullable|string',
        ]);

        Leccion::create([
            'modulo_id' => $modulo->id,
            'titulo' => $request->titulo,
            'tipo' => $request->tipo,
            'contenido' => $request->contenido,
            'url_video' => $request->url_video,
        ]);

        return redirect()->route('profesor.modulos.index', $modulo->curso) ->with('almacenado', 'Leccion creada exitosamente');
    }

    public function show(Modulo $modulo, Leccion $leccion)
    {
        // Verificar que la lección pertenece al módulo y el módulo al profesor
        if ($modulo->id != $leccion->modulo_id || $modulo->curso->user_id != Auth::id()) {
            echo "No tienes permiso para ver esta lección";
            abort(404);
        }
        
        return view('profesor.lecciones.ver_leccion')->with('leccion', $leccion)->with('modulo', $modulo);
    }

    public function destroy(Modulo $modulo, Leccion $leccion)
    {
        // Verificar que la lección pertenece al módulo y el módulo al profesor
        if ($modulo->curso->user_id != Auth::id() || $modulo->id != $leccion->modulo_id) {
            echo "No tienes permiso para eliminar esta lección";
            abort(403);
        }
        
        $leccion->delete();
        
        return redirect()->route('profesor.modulos.index', $modulo->curso)->with('eliminado', 'Leccion eliminada exitosamente');
    }
}