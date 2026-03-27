@extends('layouts.app')
@section('titulo', 'Editar Tarea')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-journal-text" style="color:var(--accent)"></i> Editar Tarea</h1>
    <a href="{{ route('tareas.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:560px; margin: 0">
    <div class="card-dark-header">
        <i class="bi bi-pencil-square" style="color:var(--accent)"></i> Datos de la tarea
    </div>
    <div class="card-dark-body">
        <form action="{{ route('tareas.update', $tarea) }}" method="POST">
            @csrf @method('PUT')

            {{-- El grupo no se puede cambiar una vez creada la tarea --}}
            <div class="form-group">
                    <div class="form-group-lg">Grupo</label>
                <div class="form-control-dark" style="color:var(--muted);cursor:not-allowed">
                    {{ $tarea->grupo->nombre }} — {{ $tarea->grupo->horario->materia->nombre ?? '?' }}
                </div>
            </div>

            <div class="form-group">
                <div class="form-group-lg">Título</label>
                <input type="text" name="titulo" value="{{ old('titulo', $tarea->titulo) }}"
                       class="form-control-dark @error('titulo') is-invalid @enderror">
                @error('titulo')
                <div style="color:#dc2626;font-size:.78rem;margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-group-lg">Descripción <span style="font-weight:400">(opcional)</span></label>
                <textarea name="descripcion" rows="4"
                          class="form-control-dark @error('descripcion') is-invalid @enderror">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                @error('descripcion')
                <div style="color:#dc2626;font-size:.78rem;margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group-lg">
                <div class="form-group-lg">Fecha límite de entrega</label>
                <input type="date" name="fecha_entrega" value="{{ old('fecha_entrega', $tarea->fecha_entrega->format('Y-m-d')) }}"
                       class="form-control-dark @error('fecha_entrega') is-invalid @enderror">
                @error('fecha_entrega')
                <div style="color:#dc2626;font-size:.78rem;margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-accent" style="width:100%">
                <i class="bi bi-check-lg"></i> Guardar Cambios
            </button>
        </form>
    </div>
</div>
@endsection