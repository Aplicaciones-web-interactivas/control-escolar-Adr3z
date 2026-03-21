@extends('layouts.app')
@section('titulo', 'Ver Horario')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-clock-fill" style="color:var(--accent)"></i> Detalle de Horario</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('horarios.edit', $horario) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('horarios.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="card-dark" style="max-width:500px">
    <div class="card-dark-header">
        <i class="bi bi-info-circle" style="color:var(--accent)"></i> Información
    </div>
    <div class="card-dark-body">
        <div class="detail-row">
            <span class="detail-label">Materia</span>
            <span class="detail-value" style="font-weight:600">{{ $horario->materia->nombre ?? '—' }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Clave</span>
            <span class="detail-value"><code>{{ $horario->materia->clave ?? '—' }}</code></span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Maestro</span>
            <span class="detail-value">{{ $horario->usuario->nombre ?? '—' }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Días</span>
            <span class="detail-value" style="color:var(--muted)">
                {{ is_array($horario->dias) ? implode(', ', $horario->dias) : $horario->dias }}
            </span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Hora Inicio</span>
            <span class="detail-value"><code>{{ $horario->hora_inicio }}</code></span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Hora Fin</span>
            <span class="detail-value"><code>{{ $horario->hora_fin }}</code></span>
        </div>
    </div>
</div>
@endsection