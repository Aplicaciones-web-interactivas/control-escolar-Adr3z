@extends('layouts.app')
@section('titulo', 'Ver Inscripción')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-person-check-fill" style="color:var(--accent)"></i> Detalle de Inscripción</h1>
    <div style="display:flex;gap:8px; flex-wrap: wrap;">
        <form action="{{ route('inscripciones.destroy', $inscripcion) }}" method="POST" 
              onclick="confirmarEliminar(this.action, '¿Dar de baja esta inscripción?'); return false;">
            @csrf @method('DELETE')
            <button type="submit" class="btn-icon-red" style="padding:7px 16px; border-radius:8px; font-weight:600; display:flex; align-items:center; gap:6px; border:none; cursor:pointer;">
                <i class="bi bi-trash3"></i> <span class="d-none d-sm-inline">Dar de baja</span>
            </button>
        </form>
        <a href="{{ route('inscripciones.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> <span class="d-none d-sm-inline">Volver</span>
        </a>
    </div>
</div>

<div class="row g-4">
    {{-- Datos del alumno --}}
    <div class="col-12 col-lg-5">
        <div class="card-dark">
            <div class="card-dark-header">
                <i class="bi bi-person-fill" style="color:var(--accent)"></i> Alumno
            </div>
            <div class="card-dark-body">
                <div class="detail-row">
                    <span class="detail-label">Nombre</span>
                    <span class="detail-value" style="font-weight:600">{{ $inscripcion->usuario->nombre ?? '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Clave</span>
                    <span class="detail-value"><code>{{ $inscripcion->usuario->clave_institucional ?? '—' }}</code></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Rol</span>
                    <span class="detail-value">
                        <span class="badge-role badge-alumno">Alumno</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Datos del grupo/horario --}}
    <div class="col-12 col-lg-7">
        <div class="card-dark">
            <div class="card-dark-header">
                <i class="bi bi-collection-fill" style="color:var(--accent2)"></i> Grupo y Horario
            </div>
            <div class="card-dark-body">
                <div class="detail-row">
                    <span class="detail-label">Grupo</span>
                    <span class="detail-value" style="font-weight:600">{{ $inscripcion->grupo->nombre ?? '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Materia</span>
                    <span class="detail-value">{{ $inscripcion->grupo->horario->materia->nombre ?? '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Maestro</span>
                    <span class="detail-value">{{ $inscripcion->grupo->horario->usuario->nombre ?? '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Días</span>
                    <span class="detail-value" style="color:var(--muted)">
                        {{ is_array($inscripcion->grupo->horario->dias ?? '') ? implode(', ', $inscripcion->grupo->horario->dias) : ($inscripcion->grupo->horario->dias ?? '—') }}
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Horario</span>
                    <span class="detail-value">
                        <code>{{ $inscripcion->grupo->horario->hora_inicio ?? '—' }} – {{ $inscripcion->grupo->horario->hora_fin ?? '' }}</code>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection