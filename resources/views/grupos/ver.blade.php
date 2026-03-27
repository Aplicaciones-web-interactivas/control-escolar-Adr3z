@extends('layouts.app')
@section('titulo', 'Ver Grupo')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-collection-fill" style="color:var(--accent)"></i> {{ $grupo->nombre }}</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('grupos.edit', $grupo) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> <span class="d-none d-sm-inline">Editar</span>
        </a>
        <a href="{{ route('grupos.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> <span class="d-none d-sm-inline">Volver</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-5">
        <div class="card-dark">
            <div class="card-dark-header">
                <i class="bi bi-info-circle" style="color:var(--accent)"></i> Información
            </div>
            <div class="card-dark-body">
                <div class="detail-row">
                    <span class="detail-label">Materia</span>
                    <span class="detail-value">{{ $grupo->horario->materia->nombre ?? '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Maestro</span>
                    <span class="detail-value">{{ $grupo->horario->usuario->nombre ?? '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Horario</span>
                    <span class="detail-value">
                        <code>{{ $grupo->horario->hora_inicio ?? '—' }} – {{ $grupo->horario->hora_fin ?? '' }}</code>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-7">
        <div class="card-dark">
            <div class="card-dark-header">
                <i class="bi bi-people-fill" style="color:var(--accent2)"></i> Alumnos Inscritos
                <span style="margin-left:auto;background:rgba(255,255,255,0.1);padding:2px 10px;border-radius:20px;font-size:.75rem">
                    {{ $grupo->inscripciones->count() }}
                </span>
            </div>
            <div class="table-responsive">
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
                            <td data-label="Nombre" style="font-weight:600">{{ $inscripcion->usuario->nombre ?? '—' }}</td>
                            <td data-label="Clave"><code>{{ $inscripcion->usuario->clave_institucional ?? '—' }}</code></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" style="text-align:center;color:var(--muted);padding:28px">Sin alumnos inscritos.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection