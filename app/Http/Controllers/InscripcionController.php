<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Grupo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with(['grupo.horario.materia', 'usuario'])->get();
        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        $grupos   = Grupo::with(['horario.materia'])->get();
        $alumnos  = Usuario::where('rol', 'alumno')->get();
        return view('inscripciones.create', compact('grupos', 'alumnos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id'   => 'required|exists:grupos,id',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        //Verificar que no exista ya la inscripción
        $existe = Inscripcion::where('grupo_id', $request->grupo_id)
                             ->where('usuario_id', $request->usuario_id)
                             ->exists();

        if ($existe) {
            return back()->withErrors(['usuario_id' => 'Este alumno ya está inscrito en ese grupo.'])->withInput();
        }

        Inscripcion::create($request->only('grupo_id', 'usuario_id'));

        return redirect()->route('inscripciones.index')->with('exito', 'Inscripción registrada correctamente.');
    }

    public function show(Inscripcion $inscripcion)
    {
        $inscripcion->load(['grupo.horario.materia', 'grupo.horario.usuario', 'usuario']);
        return view('inscripciones.ver', compact('inscripcion'));
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('inscripciones.index')->with('exito', 'Inscripción eliminada.');
    }
}