<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CalificacionController extends Controller
{
    public function index()
    {
        $query = Calificacion::with(['grupo.horario.materia', 'usuario']);
        if (Auth::user()->rol === 'alumno') {
            $query->where('usuario_id', Auth::id());
        }

        $calificaciones = $query->paginate(5);
        return view('calificaciones.index', compact('calificaciones'));
    }

    public function create()
    {
        $grupos = Grupo::with(['horario.materia'])->get();
        return view('calificaciones.create', compact('grupos'));
    }

    public function alumnosPorGrupo($grupoId)
    {
        $alumnos = Inscripcion::with('usuario')
            ->where('grupo_id', $grupoId)
            ->get()
            ->map(fn($i) => [
                'id'     => $i->usuario->id,
                'nombre' => $i->usuario->nombre,
                'clave'  => $i->usuario->clave_institucional,
            ]);

        return response()->json($alumnos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id'     => 'required|exists:grupos,id',
            'usuario_id'   => 'required|exists:usuarios,id',
            'calificacion' => 'required|numeric|min:0|max:10',
        ]);

        $existe = Calificacion::where('grupo_id', $request->grupo_id)
                              ->where('usuario_id', $request->usuario_id)
                              ->exists();

        if ($existe) {
            return back()->withErrors(['usuario_id' => 'Este alumno ya tiene calificación en ese grupo. Edítala desde el listado.'])->withInput();
        }

        Calificacion::create($request->only('grupo_id', 'usuario_id', 'calificacion'));

        return redirect()->route('calificaciones.index')->with('exito', 'Calificación registrada correctamente.');
    }

    public function show(Calificacion $calificacion)
    {
        $calificacion->load(['grupo.horario.materia', 'grupo.horario.usuario', 'usuario']);
        return view('calificaciones.ver', compact('calificacion'));
    }

    public function edit(Calificacion $calificacion)
    {
        $calificacion->load(['grupo.horario.materia', 'usuario']);
        return view('calificaciones.edit', compact('calificacion'));
    }

    public function update(Request $request, Calificacion $calificacion)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:10',
        ]);

        $calificacion->update(['calificacion' => $request->calificacion]);

        return redirect()->route('calificaciones.index')->with('exito', 'Calificación actualizada correctamente.');
    }

    public function destroy(Calificacion $calificacion)
    {
        $calificacion->delete();
        return redirect()->route('calificaciones.index')->with('exito', 'Calificación eliminada.');
    }
}