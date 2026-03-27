@extends('layouts.app')
@section('titulo', 'Ver Calificación')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-star-fill" style="color:var(--accent)"></i> Detalle</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('calificaciones.edit', $calificacion) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> <span class="d-none d-sm-inline">Editar</span>
        </a>
        <a href="{{ route('calificaciones.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> <span class="d-none d-sm-inline">Volver</span>
        </a>
    </div>
</div>

<div class="row g-4 align-items-start">
    {{-- Burbuja de calificación (12 en móvil, 4 o auto en escritorio) --}}
    <div class="col-12 col-lg-3">
        <div class="card-dark" style="text-align:center;padding:32px 20px">
            @php $c = $calificacion->calificacion; @endphp
            <div style="
                width:90px;height:90px;border-radius:50%;
                display:flex;align-items:center;justify-content:center;
                margin:0 auto 12px;font-size:1.8rem;font-weight:800;
                background:{{ !is_null($c) ? ($c >= 7 ? '#d1fae5' : ($c >= 6 ? '#fef3c7' : '#fee2e2')) : 'var(--border)' }};
                color:{{ !is_null($c) ? ($c >= 7 ? '#059669' : ($c >= 6 ? '#d97706' : '#dc2626')) : 'var(--muted)' }};
            ">
                {{ !is_null($c) ? number_format($c, 1) : '—' }}
            </div>
            <p style="font-size:.85rem;font-weight:600;color:var(--text);margin:0">
                @if(!is_null($c))
                    {{ $c >= 7 ? 'APROBADO' : ($c >= 6 ? 'SUFICIENTE' : 'REPROBADO') }}
                @else
                    SIN CALIFICACIÓN
                @endif
            </p>
        </div>
    </div>

    {{-- Datos detallados --}}
    <div class="col-12 col-lg-9">
        <div class="card-dark">
            <div class="card-dark-header">
                <i class="bi bi-info-circle" style="color:var(--accent)"></i> Información Académica
            </div>
            <div class="card-dark-body">
                <div class="detail-row">
                    <span class="detail-label">Alumno</span>
                    <span class="detail-value" style="font-weight:600">{{ $calificacion->usuario->nombre ?? '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Materia</span>
                    <span class="detail-value">{{ $calificacion->grupo->horario->materia->nombre ?? '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Grupo</span>
                    <span class="detail-value">{{ $calificacion->grupo->nombre ?? '—' }}</span>
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
</div>
@endsection