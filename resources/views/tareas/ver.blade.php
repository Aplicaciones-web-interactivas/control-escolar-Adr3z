@extends('layouts.app')
@section('titulo', 'Detalle de Tarea')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-journal-check" style="color:var(--accent)"></i> {{ $tarea->titulo }}</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('tareas.edit', $tarea) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> <span class="d-none d-sm-inline">Editar</span>
        </a>
        <a href="{{ route('tareas.index') }}" class="btn-ghost">
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
                    <span class="detail-label">Grupo</span>
                    <span class="detail-value" style="font-weight:600">{{ $tarea->grupo->nombre }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Fecha límite</span>
                    <span class="detail-value">
                        <span style="color:{{ $tarea->vencida ? '#dc2626' : '#059669' }};font-weight:600">
                            {{ $tarea->fecha_entrega->format('d/m/Y') }}
                            <small style="font-weight:400">({{ $tarea->vencida ? 'vencida' : 'vigente' }})</small>
                        </span>
                    </span>
                </div>
                @if($tarea->descripcion)
                <div class="detail-row" style="flex-direction:column;gap:6px; align-items: flex-start;">
                    <span class="detail-label">Descripción</span>
                    <span class="detail-value" style="color:var(--muted);line-height:1.5;white-space:pre-wrap">{{ $tarea->descripcion }}</span>
                </div>
                @endif
                <div class="detail-row">
                    <span class="detail-label">Entregas</span>
                    <span class="detail-value" style="font-weight:600;color:var(--accent)">{{ $tarea->entregas->count() }} / {{ $tarea->grupo->inscripciones->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-7">
        <div class="card-dark">
            <div class="card-dark-header">
                <i class="bi bi-people-fill" style="color:var(--accent2)"></i> Estado de entregas
            </div>
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Alumno</th>
                            <th style="text-align:center">Estado</th>
                            <th style="text-align:center">Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tarea->grupo->inscripciones as $inscripcion)
                        @php $entrega = $tarea->entregas->firstWhere('usuario_id', $inscripcion->usuario->id); @endphp
                        <tr>
                            <td data-label="Alumno">
                                <span style="font-weight:600">{{ $inscripcion->usuario->nombre ?? '—' }}</span>
                                <code style="display:block;font-size:.7rem">{{ $inscripcion->usuario->clave_institucional ?? '' }}</code>
                            </td>
                            <td data-label="Estado" style="text-align:center">
                                @if($entrega)
                                    <span class="badge-role badge-activo">Entregó</span>
                                @else
                                    <span class="badge-role badge-inactivo">Pendiente</span>
                                @endif
                            </td>
                            <td data-label="Archivo" style="text-align:center">
                                @if($entrega)
                                    <a href="{{ route('tareas.entregas.descargar', $entrega) }}" class="btn-icon btn-icon-blue" target="_blank">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>
                                @else
                                    <span style="color:var(--border)">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align:center;color:var(--muted);padding:28px">Sin alumnos inscritos.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection