@extends('layouts.app')
@section('titulo', 'Ver Usuario')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-person-badge-fill" style="color:var(--accent2)"></i> {{ $usuario->nombre }}</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> <span class="d-none d-sm-inline">Editar</span>
        </a>
        <a href="{{ route('usuarios.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> <span class="d-none d-sm-inline">Volver</span>
        </a>
    </div>
</div>

{{-- Cambiamos el estilo en línea por una clase o ajuste de grid responsivo --}}
<div class="row g-4">
    {{-- Detalle (Ocupa 12 columnas en móvil, 5 en escritorio) --}}
    <div class="col-12 col-lg-5">
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
    </div>

    {{-- Panel derecho (Ocupa 12 columnas en móvil, 7 en escritorio) --}}
    <div class="col-12 col-lg-7">
        @if($usuario->rol === 'maestro')
        <div class="card-dark">
            <div class="card-dark-header">
                <i class="bi bi-clock-fill" style="color:var(--accent)"></i> Horarios Asignados
            </div>
            <div class="table-responsive">
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
                            <td data-label="Materia" style="font-weight:600">{{ $h->materia->nombre ?? '—' }}</td>
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
        @else
        <div class="card-dark">
            <div class="card-dark-header">
                <div style="display:flex; align-items:center; width:100%">
                    <i class="bi bi-collection-fill" style="color:var(--accent)"></i> 
                    <span style="margin-left:8px">Grupos Inscritos</span>
                    <span style="margin-left:auto;background:rgba(255,255,255,0.1);padding:2px 10px;border-radius:20px;font-size:.75rem">
                        {{ $usuario->inscripciones->count() }}
                    </span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Materia</th>
                            <th style="text-align:center">Horario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuario->inscripciones as $ins)
                        <tr>
                            <td data-label="Grupo" style="font-weight:600">{{ $ins->grupo->nombre ?? '—' }}</td>
                            <td data-label="Materia">{{ $ins->grupo->horario->materia->nombre ?? '—' }}</td>
                            <td data-label="Horario" style="text-align:center">
                                <code>{{ $ins->grupo->horario->hora_inicio ?? '—' }} – {{ $ins->grupo->horario->hora_fin ?? '' }}</code>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align:center;color:var(--muted);padding:28px">Sin grupos inscritos.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection