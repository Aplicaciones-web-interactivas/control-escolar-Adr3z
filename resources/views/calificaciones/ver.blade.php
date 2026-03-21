@extends('layouts.app')
@section('titulo', 'Ver Calificación')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-star-fill" style="color:var(--accent)"></i> Detalle de Calificación</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('calificaciones.edit', $calificacion) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('calificaciones.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div style="display:grid;grid-template-columns:auto 1fr;gap:20px;align-items:start">

    {{-- Burbuja de calificación --}}
    <div class="card-dark" style="text-align:center;padding:32px 40px">
        @php $c = $calificacion->calificacion; @endphp
        <div style="
            width:100px;height:100px;border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            margin:0 auto 12px;font-size:2rem;font-weight:800;
            background:{{ !is_null($c) ? ($c >= 7 ? '#d1fae5' : ($c >= 6 ? '#fef3c7' : '#fee2e2')) : '#f1f5f9' }};
            color:{{ !is_null($c) ? ($c >= 7 ? '#059669' : ($c >= 6 ? '#d97706' : '#dc2626')) : 'var(--muted)' }};
        ">
            {{ !is_null($c) ? number_format($c, 1) : '—' }}
        </div>
        <p style="font-size:.8rem;color:var(--muted);margin:0">
            @if(!is_null($c))
                {{ $c >= 7 ? 'Aprobado' : ($c >= 6 ? 'Suficiente' : 'Reprobado') }}
            @else
                Sin calificación
            @endif
        </p>
    </div>

    {{-- Datos --}}
    <div class="card-dark">
        <div class="card-dark-header">
            <i class="bi bi-info-circle" style="color:var(--accent)"></i> Información
        </div>
        <div class="card-dark-body">
            <div class="detail-row">
                <span class="detail-label">Alumno</span>
                <span class="detail-value" style="font-weight:600">{{ $calificacion->usuario->nombre ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Clave</span>
                <span class="detail-value"><code>{{ $calificacion->usuario->clave_institucional ?? '—' }}</code></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Grupo</span>
                <span class="detail-value">{{ $calificacion->grupo->nombre ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Materia</span>
                <span class="detail-value">{{ $calificacion->grupo->horario->materia->nombre ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Clave materia</span>
                <span class="detail-value"><code>{{ $calificacion->grupo->horario->materia->clave ?? '—' }}</code></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Maestro</span>
                <span class="detail-value">{{ $calificacion->grupo->horario->usuario->nombre ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Horario</span>
                <span class="detail-value">
                    <code>{{ $calificacion->grupo->horario->hora_inicio ?? '—' }} – {{ $calificacion->grupo->horario->hora_fin ?? '' }}</code>
                </span>
            </div>
        </div>
    </div>

</div>
@endsection