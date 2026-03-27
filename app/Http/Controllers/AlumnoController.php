<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Inscripcion;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
{
    private function soloAlumno()
    {
        if (!Auth::check() || Auth::user()->rol !== 'alumno') {
            abort(403);
        }
    }

    public function dashboard()
    {
        $this->soloAlumno();
        $alumno        = Auth::user();
        $misGrupos     = Inscripcion::with(['grupo.horario.materia'])->where('usuario_id', $alumno->id)->get();
        $misCalifs     = Calificacion::with(['grupo.horario.materia'])->where('usuario_id', $alumno->id)->get();
        $materiasCount = Materia::count();

        return view('alumno.dashboard', compact('alumno', 'misGrupos', 'misCalifs', 'materiasCount'));
    }
}