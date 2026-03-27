@extends('layouts.app')
@section('titulo', 'Nueva Tarea')

@section('contenido')

<div class="topbar">
    <h1 class="page-title"><i class="bi bi-journal-plus" style="color:var(--accent)"></i> Nueva Tarea</h1>
    <a href="{{ route('tareas.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:560px; margin: 0">
    <div class="card-dark-header">
        <i class="bi bi-pencil-square" style="color:var(--accent)"></i> Datos de la tarea
    </div>
    <div class="card-dark-body">
        <form action="{{ route('tareas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="label">Grupo</label>
                <select name="grupo_id" class="form-select-dark">
                    <option value="">— Selecciona un grupo —</option>
                    @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                        {{ $grupo->nombre }} — {{ $grupo->horario->materia->nombre ?? '?' }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="label">Título</label>
                <input type="text" name="titulo" value="{{ old('titulo') }}"
                       class="form-control-dark"
                       placeholder="Ej. Tarea 1 — Introducción" required>
            </div>

            <div class="form-group">
                <label class="label">Descripción <span style="font-weight:400">(opcional)</span></label>
                <textarea name="descripcion" rows="4"
                          class="form-control-dark"
                          placeholder="Instrucciones, criterios de evaluación...">{{ old('descripcion') }}</textarea>
            </div>

            <div style="margin-bottom:24px">
                <label class="label">Fecha límite de entrega</label>
                <input type="date" name="fecha_entrega" value="{{ old('fecha_entrega') }}"
                       class="form-control-dark" required>
            </div>

            <button type="submit" class="btn-accent" style="width:100%">
                <i class="bi bi-check-lg"></i> Crear Tarea
            </button>
        </form>
    </div>
</div>
@endsection