@extends('layouts.app')
@section('titulo', 'Ver Usuario')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-person-badge-fill" style="color:var(--accent2)"></i> {{ $usuario->nombre }}</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('usuarios.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:20px">

    {{-- Detalle --}}
    <div class="card-dark">
        <div class="card-dark-header">
            <i class="bi bi-info-circle" style="color:var(--accent2)"></i> Información
        </div>
        <div class="card-dark-body">
            <div class="detail-row">
                <span class="detail-label">Nombre</span>
                <span class="detail-value" style="font-weight:600">{{ $usuario->nombre }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Clave Institucional</span>
                <span class="detail-value"><code>{{ $usuario->clave_institucional }}</code></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Rol</span>
                <span class="detail-value">
                    <span class="badge-role badge-{{ $usuario->rol }}">{{ ucfirst($usuario->rol) }}</span>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Estado</span>
                <span class="detail-value">
                    @if($usuario->activo)
                        <span class="badge-role badge-activo"><i class="bi bi-circle-fill me-1" style="font-size:.45rem"></i>Activo</span>
                    @else
                        <span class="badge-role badge-inactivo"><i class="bi bi-circle-fill me-1" style="font-size:.45rem"></i>Inactivo</span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    {{-- Horarios --}}
    <div class="card-dark">
        <div class="card-dark-header">
            <i class="bi bi-clock-fill" style="color:var(--accent)"></i> Horarios Asignados
        </div>
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Días</th>
                    <th>Horario</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuario->horarios as $h)
                <tr>
                    <td style="font-weight:600">{{ $h->materia->nombre ?? '—' }}</td>
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