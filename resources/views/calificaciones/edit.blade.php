@extends('layouts.app')
@section('titulo', 'Editar Calificación')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-pencil-fill" style="color:#fbbf24"></i> Editar Calificación</h1>
    <a href="{{ route('calificaciones.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:480px">
    <div class="card-dark-header">
        <i class="bi bi-star-fill" style="color:#fbbf24"></i>
        {{ $calificacion->usuario->nombre ?? '—' }} — {{ $calificacion->grupo->nombre ?? '—' }}
    </div>
    <div class="card-dark-body">

        {{-- Info de solo lectura --}}
        <div style="background:var(--bg);border:1px solid var(--border);border-radius:10px;padding:14px 16px;margin-bottom:20px;display:grid;gap:8px">
            <div style="display:flex;justify-content:space-between;font-size:.85rem">
                <span style="color:var(--muted)">Materia</span>
                <span style="font-weight:600">{{ $calificacion->grupo->horario->materia->nombre ?? '—' }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:.85rem">
                <span style="color:var(--muted)">Grupo</span>
                <span>{{ $calificacion->grupo->nombre ?? '—' }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:.85rem">
                <span style="color:var(--muted)">Alumno</span>
                <span>{{ $calificacion->usuario->nombre ?? '—' }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:.85rem">
                <span style="color:var(--muted)">Clave</span>
                <code>{{ $calificacion->usuario->clave_institucional ?? '—' }}</code>
            </div>
        </div>

        <form action="{{ route('calificaciones.update', $calificacion) }}" method="POST">
            @csrf @method('PUT')

            <div>
                <label class="form-label-dark">Calificación <span style="color:var(--muted);font-weight:400;text-transform:none;letter-spacing:0">(0 – 10)</span></label>
                <input type="number" name="calificacion" step="0.01" min="0" max="10"
                       class="form-control-dark {{ $errors->has('calificacion') ? 'is-invalid' : '' }}"
                       value="{{ old('calificacion', $calificacion->calificacion) }}"
                       required autofocus>
                @error('calificacion')<div class="invalid-msg">{{ $message }}</div>@enderror
            </div>

            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-save"></i> Actualizar
                </button>
                <a href="{{ route('calificaciones.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection