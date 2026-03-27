@extends('layouts.app')
@section('titulo', 'Tareas')

@section('contenido')

<div class="topbar">
    <h1 class="page-title"><i class="bi bi-journal-check" style="color:var(--accent)"></i> Tareas</h1>
    <a href="{{ route('tareas.create') }}" class="btn-accent">
        <i class="bi bi-plus-lg"></i> <span class="d-none d-sm-inline">Nueva Tarea</span>
    </a>
</div>

<div class="card-dark">
    <div class="table-container">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>Tarea / Materia</th>
                    <th class="d-none d-md-table-cell">Grupo</th>
                    <th style="text-align:center">Límite</th>
                    <th style="text-align:center">Entregas</th>
                    <th style="text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tareas as $tarea)
                <tr>
                    <td>
                        <div style="font-weight:600">{{ $tarea->titulo }}</div>
                        <div style="font-size:.75rem; color:var(--muted)" class="d-md-none">
                            {{ $tarea->grupo->nombre }} · {{ $tarea->grupo->horario->materia->nombre ?? '—' }}
                        </div>
                        <div style="font-size:.75rem; color:var(--muted)" class="d-none d-md-block">
                            {{ $tarea->grupo->horario->materia->nombre ?? '—' }}
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell">{{ $tarea->grupo->nombre }}</td>
                    <td class="text-center">
                            <span style="color:{{ $tarea->vencida ? '#dc2626' : 'inherit' }}; font-size:.85rem">
                            {{ $tarea->fecha_entrega->format('d/m') }}
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="badge-pill">
                        {{ $tarea->entregas->count() }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="flex-center flex-gap-4">
                        <a href="{{ route('tareas.show', $tarea) }}" class="btn-icon btn-icon-blue"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('tareas.edit', $tarea) }}" class="btn-icon btn-icon-amber"><i class="bi bi-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;padding:40px">No hay tareas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection