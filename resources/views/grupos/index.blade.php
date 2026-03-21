@extends('layouts.app')
@section('titulo', 'Grupos')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-collection-fill" style="color:var(--accent)"></i> Grupos</h1>
    <a href="{{ route('grupos.create') }}" class="btn-accent">
        <i class="bi bi-plus-lg"></i> Nuevo Grupo
    </a>
</div>

<div class="card-dark">
    <div class="table-responsive">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Materia</th>
                    <th>Maestro</th>
                    <th>Días</th>
                    <th style="text-align:center">Horario</th>
                    <th style="text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grupos as $grupo)
                <tr>
                    <td style="color:var(--muted)">{{ $grupo->id }}</td>
                    <td style="font-weight:600">{{ $grupo->nombre }}</td>
                    <td>
                        <span style="font-weight:600">{{ $grupo->horario->materia->nombre ?? '—' }}</span>
                        <code style="font-size:.7rem;display:block">{{ $grupo->horario->materia->clave ?? '' }}</code>
                    </td>
                    <td style="color:var(--muted)">{{ $grupo->horario->usuario->nombre ?? '—' }}</td>
                    <td style="color:var(--muted)">
                        {{ is_array($grupo->horario->dias ?? '') ? implode(', ', $grupo->horario->dias) : ($grupo->horario->dias ?? '—') }}
                    </td>
                    <td style="text-align:center">
                        <code>{{ $grupo->horario->hora_inicio ?? '—' }} – {{ $grupo->horario->hora_fin ?? '' }}</code>
                    </td>
                    <td style="text-align:center">
                        <div style="display:flex;justify-content:center;gap:6px">
                            <a href="{{ route('grupos.show', $grupo) }}" class="btn-icon btn-icon-blue" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('grupos.edit', $grupo) }}" class="btn-icon btn-icon-amber" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('grupos.destroy', $grupo) }}" method="POST" style="display:inline"
                                  onclick="confirmarEliminar(this.action, '¿Eliminar este grupo? Esta acción no se puede deshacer.'); return false;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon-red" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:var(--muted);padding:40px">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px"></i>
                        No hay grupos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(method_exists($grupos, 'links'))
<div style="margin-top:16px">{{ $grupos->links() }}</div>
@endif
@endsection