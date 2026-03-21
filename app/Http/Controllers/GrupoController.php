<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::with(['horario.materia', 'horario.usuario'])->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $horarios = Horario::with(['materia', 'usuario'])->get();
        $grupo    = null;
        return view('grupos.create', compact('horarios', 'grupo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:100',
            'horario_id' => 'required|exists:horarios,id',
        ]);

        Grupo::create($request->only('nombre', 'horario_id'));

        return redirect()->route('grupos.index')->with('exito', 'Grupo registrado correctamente.');
    }

    public function show(Grupo $grupo)
    {
        $grupo->load(['horario.materia', 'horario.usuario', 'inscripciones.usuario']);
        return view('grupos.ver', compact('grupo'));
    }

    public function edit(Grupo $grupo)
    {
        $horarios = Horario::with(['materia', 'usuario'])->get();
        return view('grupos.edit', compact('grupo', 'horarios'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre'     => 'required|string|max:100',
            'horario_id' => 'required|exists:horarios,id',
        ]);

        $grupo->update($request->only('nombre', 'horario_id'));

        return redirect()->route('grupos.index')->with('exito', 'Grupo actualizado correctamente.');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();
        return redirect()->route('grupos.index')->with('exito', 'Grupo eliminado.');
    }
}