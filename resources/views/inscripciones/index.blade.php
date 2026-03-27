@extends('layouts.app')
@section('titulo', 'Inscripciones')

@section('contenido')

<div class="topbar">
    <h1 class="page-title topbar-title">
        <i class="bi bi-person-check-fill"></i>
        Inscripciones
    </h1>

    <a href="{{ route('inscripciones.create') }}" class="btn-accent">
    <i class="bi bi-plus-lg"></i> Nueva Inscripción</a>
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
                    <th style="text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inscripciones as $inscripcion)
                <tr>
                    <td data-label="#" style="color:var(--muted)">{{ $inscripcion->id }}</td>
                    <td data-label="Alumno" style="font-weight:600">{{ $inscripcion->usuario->nombre ?? '—' }}</td>
                    <td data-label="Clave"><code>{{ $inscripcion->usuario->clave_institucional ?? '—' }}</code></td>
                    <td data-label="Grupo">{{ $inscripcion->grupo->nombre ?? '—' }}</td>
                    <td data-label="Materia">{{ $inscripcion->grupo->horario->materia->nombre ?? '—' }}</td>
                    <td data-label="Acciones" style="text-align:center">
                        <div style="display:flex;justify-content:center;gap:6px">
                            <a href="{{ route('inscripciones.show', $inscripcion) }}" class="btn-icon btn-icon-blue" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('inscripciones.destroy', $inscripcion) }}" method="POST" style="display:inline"
                                  onclick="confirmarEliminar(this.action, '¿Dar de baja esta inscripción?'); return false;">
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