@extends('layouts.app')
@section('titulo', 'Detalle de Tarea')

@section('contenido')
<style>
    .grid-layout { display: grid; grid-template-columns: 1fr 1.6fr; gap: 20px; align-items: start; }
    @media (max-width: 992px) {
        .grid-layout { grid-template-columns: 1fr; }
        .topbar { flex-direction: column; gap: 10px; }
    }
</style>

<div class="topbar">
    <h1 class="page-title"><i class="bi bi-journal-check" style="color:var(--accent)"></i> {{ $tarea->titulo }}</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('tareas.edit', $tarea) }}" class="btn-accent">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('tareas.index') }}" class="btn-ghost">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="grid-layout">

    {{-- Info de la tarea --}}
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
                <span class="detail-label">Materia</span>
                <span class="detail-value">{{ $tarea->grupo->horario->materia->nombre ?? '—' }}</span>
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
            <div class="detail-row" style="flex-direction:column;gap:6px">
                <span class="detail-label">Descripción</span>
                <span class="detail-value" style="color:var(--muted);line-height:1.5;white-space:pre-wrap">{{ $tarea->descripcion }}</span>
            </div>
            @endif
            <div class="detail-row">
                <span class="detail-label">Inscritos</span>
                <span class="detail-value">{{ $tarea->grupo->inscripciones->count() }} alumnos</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Entregaron</span>
                <span class="detail-value" style="font-weight:600;color:var(--accent)">{{ $tarea->entregas->count() }} / {{ $tarea->grupo->inscripciones->count() }}</span>
            </div>
        </div>
    </div>

    {{-- Lista de alumnos y su estado --}}
    <div class="card-dark">
        <div class="card-dark-header">
            <i class="bi bi-people-fill" style="color:var(--accent2)"></i> Estado de entregas
        </div>
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center">Entrega</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tarea->grupo->inscripciones as $inscripcion)
                @php
                    $entrega = $tarea->entregas->firstWhere('usuario_id', $inscripcion->usuario->id);
                @endphp
                <tr>
                    <td>
                        <span style="font-weight:600">{{ $inscripcion->usuario->nombre ?? '—' }}</span>
                        <code style="display:block;font-size:.7rem">{{ $inscripcion->usuario->clave_institucional ?? '' }}</code>
                    </td>
                    <td style="text-align:center">
                        @if($entrega)
                            <span style="background:#d1fae5;color:#065f46;padding:3px 10px;border-radius:20px;font-size:.75rem;font-weight:600">
                                <i class="bi bi-check-circle-fill"></i> Entregó
                            </span>
                        @else
                            <span style="background:#fee2e2;color:#991b1b;padding:3px 10px;border-radius:20px;font-size:.75rem;font-weight:600">
                                <i class="bi bi-x-circle-fill"></i> Pendiente
                            </span>
                        @endif
                    </td>
                    <td style="text-align:center">
    @if($entrega)
        <a href="{{ route('tareas.entregas.descargar', $entrega) }}" 
           class="btn-icon btn-icon-blue" 
           title="Ver PDF" 
           target="_blank">
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
@endsection