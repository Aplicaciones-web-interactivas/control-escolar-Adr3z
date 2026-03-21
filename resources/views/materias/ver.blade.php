@extends('layouts.app')
@section('titulo', 'Ver Materia')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-book-fill" style="color:var(--accent2)"></i> {{ $materia->nombre }}</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('materias.edit', $materia) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('materias.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1.6fr;gap:20px">

    {{-- Detalle --}}
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

    {{-- Horarios --}}
    <div class="card-dark">
        <div class="card-dark-header">
            <i class="bi bi-clock-fill" style="color:var(--accent)"></i> Horarios de esta Materia
        </div>
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
                    <td style="font-weight:600">{{ $h->usuario->nombre ?? '—' }}</td>
                    <td style="color:var(--muted)">{{ is_array($h->dias) ? implode(', ', $h->dias) : $h->dias }}</td>
                    <td><code>{{ $h->hora_inicio }} – {{ $h->hora_fin }}</code></td>
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
@endsection