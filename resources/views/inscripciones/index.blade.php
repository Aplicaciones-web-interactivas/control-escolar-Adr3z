@extends('layouts.app')
@section('titulo', 'Inscripciones')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-person-check-fill" style="color:var(--accent)"></i> Inscripciones</h1>
    <a href="{{ route('inscripciones.create') }}" class="btn-accent">
        <i class="bi bi-plus-lg"></i> Nueva Inscripción
    </a>
</div>

<div class="card-dark">
    <div class="table-responsive">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Alumno</th>
                    <th>Clave</th>
                    <th>Grupo</th>
                    <th>Materia</th>
                    <th>Horario</th>
                    <th style="text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inscripciones as $inscripcion)
                <tr>
                    <td style="color:var(--muted)">{{ $inscripcion->id }}</td>
                    <td style="font-weight:600">{{ $inscripcion->usuario->nombre ?? '—' }}</td>
                    <td><code>{{ $inscripcion->usuario->clave_institucional ?? '—' }}</code></td>
                    <td>{{ $inscripcion->grupo->nombre ?? '—' }}</td>
                    <td>{{ $inscripcion->grupo->horario->materia->nombre ?? '—' }}</td>
                    <td style="color:var(--muted)">
                        {{ is_array($inscripcion->grupo->horario->dias ?? '') ? implode(', ', $inscripcion->grupo->horario->dias) : ($inscripcion->grupo->horario->dias ?? '—') }}
                        <code style="font-size:.7rem">
                            {{ $inscripcion->grupo->horario->hora_inicio ?? '' }}
                            – {{ $inscripcion->grupo->horario->hora_fin ?? '' }}
                        </code>
                    </td>
                    <td style="text-align:center">
                        <div style="display:flex;justify-content:center;gap:6px">
                            <a href="{{ route('inscripciones.show', $inscripcion) }}" class="btn-icon btn-icon-blue" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('inscripciones.destroy', $inscripcion) }}" method="POST" style="display:inline"
                                  onclick="confirmarEliminar(this.action, '¿Dar de baja esta inscripción? El alumno perderá el acceso al grupo.'); return false;">
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
                        No hay inscripciones registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(method_exists($inscripciones, 'links'))
<div style="margin-top:16px">{{ $inscripciones->links() }}</div>
@endif
@endsection