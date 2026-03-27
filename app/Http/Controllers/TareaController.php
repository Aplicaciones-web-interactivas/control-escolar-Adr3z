<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Entrega;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


//Hola buenas noches,
//Un maestro puede dejar una tarea solo de los grupos que tiene asignados
//La tarea puede editarse aunque eso no lo pidió en el pdf
//Los alumnos pueden visualizar sus tareas asignadas y subir unicamente archivos en formato PDF como entrega
//Los maestros deben poder revisar los archivos entregados


class TareaController extends Controller
{
    // ── MAESTRO ───────────────────────────────────────────────────────────────

    // Lista todas las tareas de los grupos que imparte el maestro
    public function index()
    {
        $this->soloMaestro();

        // Grupos donde el maestro está asignado a través del horario
        $gruposIds = Grupo::whereHas('horario', function ($q) {
            $q->where('usuario_id', Auth::id());
        })->pluck('id');

        $tareas = Tarea::with(['grupo.horario.materia', 'entregas'])
            ->whereIn('grupo_id', $gruposIds)
            ->orderBy('fecha_entrega')
            ->paginate(15);

        return view('tareas.index', compact('tareas'));
    }

    // Formulario para crear una tarea
    public function create()
    {
        $this->soloMaestro();

        $grupos = Grupo::whereHas('horario', function ($q) {
            $q->where('usuario_id', Auth::id());
        })->with('horario.materia')->get();

        return view('tareas.create', compact('grupos'));
    }

    // Guardar nueva tarea
    public function store(Request $request)
    {
        $this->soloMaestro();

        $request->validate([
            'grupo_id'      => 'required|exists:grupos,id',
            'titulo'        => 'required|string|max:200',
            'descripcion'   => 'nullable|string',
            'fecha_entrega' => 'required|date',
        ]);

        // Verificar que el grupo pertenece al maestro
        $perteneceAlMaestro = Grupo::where('id', $request->grupo_id)
            ->whereHas('horario', fn($q) => $q->where('usuario_id', Auth::id()))
            ->exists();

        if (!$perteneceAlMaestro) {
            abort(403);
        }

        Tarea::create($request->only('grupo_id', 'titulo', 'descripcion', 'fecha_entrega'));

        return redirect()->route('tareas.index')->with('exito', 'Tarea creada correctamente.');
    }

    // Ver detalle de una tarea con sus entregas
    public function show(Tarea $tarea)
    {
        $this->soloMaestro();
        $this->verificarPropietario($tarea);

        $tarea->load(['grupo.horario.materia', 'grupo.inscripciones.usuario', 'entregas.usuario']);

        return view('tareas.ver', compact('tarea'));
    }

    // Formulario editar
    public function edit(Tarea $tarea)
    {
        $this->soloMaestro();
        $this->verificarPropietario($tarea);

        $grupos = Grupo::whereHas('horario', function ($q) {
            $q->where('usuario_id', Auth::id());
        })->with('horario.materia')->get();

        return view('tareas.edit', compact('tarea', 'grupos'));
    }

    // Guardar edición
    public function update(Request $request, Tarea $tarea)
    {
        $this->soloMaestro();
        $this->verificarPropietario($tarea);

        $request->validate([
            'titulo'        => 'required|string|max:200',
            'descripcion'   => 'nullable|string',
            'fecha_entrega' => 'required|date',
        ]);

        $tarea->update($request->only('titulo', 'descripcion', 'fecha_entrega'));

        return redirect()->route('tareas.index')->with('exito', 'Tarea actualizada.');
    }

    public function descargarEntrega(Entrega $entrega)
    {
        $this->soloMaestro();
        $this->verificarPropietario($entrega->tarea);

        // Verificamos si el archivo existe en el disco public
        if (!Storage::disk('public')->exists($entrega->archivo)) {
            abort(404, 'El archivo no existe en el servidor.');
        }

        // Devolvemos el archivo para que se abra en el navegador
        return response()->file(storage_path('app/public/' . $entrega->archivo));
    }

    // ── ALUMNO ────────────────────────────────────────────────────────────────

    // Lista las tareas de los grupos donde está inscrito el alumno
    public function misTablas()
    {
        $this->soloAlumno();

        $gruposIds = Auth::user()->inscripciones()->pluck('grupo_id');

        $tareas = Tarea::with(['grupo.horario.materia', 'entregas' => function ($q) {
            $q->where('usuario_id', Auth::id());
        }])
            ->whereIn('grupo_id', $gruposIds)
            ->orderBy('fecha_entrega')
            ->paginate(15);

        return view('tareas.alumno_index', compact('tareas'));
    }

    // Subir entrega PDF
    public function subirEntrega(Request $request, Tarea $tarea)
    {
        $this->soloAlumno();

        // Verificar inscripción
        $inscrito = Auth::user()->inscripciones()->where('grupo_id', $tarea->grupo_id)->exists();
        if (!$inscrito) {
            abort(403, 'No estás inscrito en este grupo.');
        }

        $request->validate([
            'archivo' => 'required|file|mimes:pdf|max:10240', // Tañamo del archivo
            'archivo.required' => 'Debes subir un archivo PDF', //Alertas
            'archivo.mimes' => 'El archivo debe ser un PDF'
        ]);

        // Buscar si ya existe una entrega previa
        $entrega = Entrega::firstOrNew([
            'tarea_id'   => $tarea->id,
            'usuario_id' => Auth::id(),
        ]);

        // Si ya había un archivo, lo eliminamos físicamente
        if ($entrega->archivo) {
            Storage::disk('public')->delete($entrega->archivo);
        }

        // Guardar el nuevo archivo
        $rutaCargada = $request->file('archivo')->store('entregas', 'public');

        $entrega->archivo = $rutaCargada;
        $entrega->save();

        return redirect()->route('alumno.tareas')->with('exito', 'Entrega subida o actualizada correctamente.');
    }

    private function soloMaestro()
    {
        if (!Auth::check() || Auth::user()->rol !== 'maestro') {
            abort(403);
        }
    }

    private function soloAlumno()
    {
        if (!Auth::check() || Auth::user()->rol !== 'alumno') {
            abort(403);
        }
    }

    private function verificarPropietario(Tarea $tarea)
    {
        $tarea->loadMissing('grupo.horario');
        if ($tarea->grupo->horario->usuario_id !== Auth::id()) {
            abort(403);
        }
    }

    // Saber si la tarea está vencida o no
    public function getVencidaAttribute()
    {
        return $this->fecha_entrega->isPast();
    }
}