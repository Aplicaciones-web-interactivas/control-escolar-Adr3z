@extends('layouts.app')
@section('titulo', 'Ver Materia')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-book-fill" style="color:var(--accent2)"></i> {{ $materia->nombre }}</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('materias.edit', $materia) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> <span class="d-none d-sm-inline">Editar</span>
        </a>
        <a href="{{ route('materias.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> <span class="d-none d-sm-inline">Volver</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-4">
        <div class="card-dark">
            <div class="card-dark-header">
                <i class="bi bi-info-circle" style="color:var(--accent2)"></i> Información
            </div>
            <div class="card-dark-body">
                <div class="detail-row">
                    <span class="detail-label">Nombre</span>
                    <span class="detail-value" style="font-weight:600">{{ $materia->nombre }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Clave</span>
                    <span class="detail-value"><code>{{ $materia->clave }}</code></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="card-dark">
            <div class="card-dark-header">
                <i class="bi bi-clock-fill" style="color:var(--accent)"></i> Horarios de esta Materia
            </div>
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Maestro</th>
                            <th>Días</th>
                            <th>Horario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materia->horarios as $h)
                        <tr>
                            <td data-label="Maestro" style="font-weight:600">{{ $h->usuario->nombre ?? '—' }}</td>
                            <td data-label="Días" style="color:var(--muted)">{{ is_array($h->dias) ? implode(', ', $h->dias) : $h->dias }}</td>
                            <td data-label="Horario"><code>{{ $h->hora_inicio }} – {{ $h->hora_fin }}</code></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align:center;color:var(--muted);padding:28px">Sin horarios asignados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection