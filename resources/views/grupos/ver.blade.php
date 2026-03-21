@extends('layouts.app')
@section('titulo', 'Ver Grupo')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-collection-fill" style="color:var(--accent)"></i> {{ $grupo->nombre }}</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('grupos.edit', $grupo) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('grupos.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1.6fr;gap:20px">

    {{-- Detalle --}}
    <div class="card-dark">
        <div class="card-dark-header">
            <i class="bi bi-info-circle" style="color:var(--accent)"></i> Información
        </div>
        <div class="card-dark-body">
            <div class="detail-row">
                <span class="detail-label">Nombre</span>
                <span class="detail-value" style="font-weight:600">{{ $grupo->nombre }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Materia</span>
                <span class="detail-value">{{ $grupo->horario->materia->nombre ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Clave</span>
                <span class="detail-value"><code>{{ $grupo->horario->materia->clave ?? '—' }}</code></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Maestro</span>
                <span class="detail-value">{{ $grupo->horario->usuario->nombre ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Días</span>
                <span class="detail-value" style="color:var(--muted)">
                    {{ is_array($grupo->horario->dias ?? '') ? implode(', ', $grupo->horario->dias) : ($grupo->horario->dias ?? '—') }}
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Horario</span>
                <span class="detail-value">
                    <code>{{ $grupo->horario->hora_inicio ?? '—' }} – {{ $grupo->horario->hora_fin ?? '' }}</code>
                </span>
            </div>
        </div>
    </div>

    {{-- Alumnos inscritos --}}
    <div class="card-dark">
        <div class="card-dark-header">
            <i class="bi bi-people-fill" style="color:var(--accent2)"></i> Alumnos Inscritos
            <span style="margin-left:auto;background:var(--border);padding:2px 10px;border-radius:20px;font-size:.75rem">
                {{ $grupo->inscripciones->count() }}
            </span>
        </div>
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Clave Institucional</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grupo->inscripciones as $inscripcion)
                <tr>
                    <td style="font-weight:600">{{ $inscripcion->usuario->nombre ?? '—' }}</td>
                    <td><code>{{ $inscripcion->usuario->clave_institucional ?? '—' }}</code></td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" style="text-align:center;color:var(--muted);padding:28px">
                        Sin alumnos inscritos.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection