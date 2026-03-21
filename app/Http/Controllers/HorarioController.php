<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Materia;
use App\Models\Usuario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::with(['materia', 'usuario'])->get();
        $materias = Materia::all();
        $usuarios = Usuario::where('rol', 'maestro')->get();
        return view('horarios.index', compact('horarios', 'materias', 'usuarios'));
    }

    public function create()
    {
        $materias = Materia::all();
        $usuarios = Usuario::where('rol', 'maestro')->get();
        $horario  = null;
        return view('horarios.create', compact('materias', 'usuarios', 'horario'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'materia_id'  => 'required|exists:materias,id',
            'usuario_id'  => 'nullable|exists:usuarios,id',
            'dias'        => 'required|array',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required',
        ]);

        $datos['dias'] = implode(', ', $request->dias);

        Horario::create($datos);

        return redirect()->route('horarios.index')->with('exito', 'Horario registrado correctamente.');
    }

    public function show(Horario $horario)
    {
        return view('horarios.ver', compact('horario'));
    }

    public function edit(Horario $horario)
    {
        $materias = Materia::all();
        $usuarios = Usuario::where('rol', 'maestro')->get();
        return view('horarios.edit', compact('horario', 'materias', 'usuarios'));
    }

    public function update(Request $request, Horario $horario)
    {
        $datos = $request->validate([
            'materia_id'  => 'required|exists:materias,id',
            'usuario_id'  => 'nullable|exists:usuarios,id',
            'dias'        => 'required|array',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required',
        ]);

        $datos['dias'] = implode(', ', $request->dias);

        $horario->update($datos);

        return redirect()->route('horarios.index')->with('exito', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('exito', 'Horario eliminado.');
    }
}