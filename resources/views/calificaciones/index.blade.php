@extends('layouts.app')
@section('titulo', 'Calificaciones')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-star-fill" style="color:var(--accent)"></i> Calificaciones</h1>
    @if(Auth::user()->rol === 'maestro')
    <a href="{{ route('calificaciones.create') }}" class="btn-accent">
        <i class="bi bi-plus-lg"></i> Nueva Calificación
    </a>
    @endif
</div>

<div class="card-dark">
    <div class="table-responsive">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    @if(Auth::user()->rol === 'maestro')
                    <th>Alumno</th>
                    <th>Clave</th>
                    @endif
                    <th>Grupo</th>
                    <th>Materia</th>
                    <th style="text-align:center">Calificación</th>
                    @if(Auth::user()->rol === 'maestro')
                    <th style="text-align:center">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($calificaciones as $cal)
                <tr>
                    <td data-label="#" style="color:var(--muted)">{{ $cal->id }}</td>
                    
                    @if(Auth::user()->rol === 'maestro')
                    <td data-label="Alumno" style="font-weight:600">{{ $cal->usuario->nombre ?? '—' }}</td>
                    <td data-label="Clave"><code>{{ $cal->usuario->clave_institucional ?? '—' }}</code></td>
                    @endif
                    
                    <td data-label="Grupo">{{ $cal->grupo->nombre ?? '—' }}</td>
                    <td data-label="Materia">{{ $cal->grupo->horario->materia->nombre ?? '—' }}</td>
                    
                    <td data-label="Calificación" style="text-align:center">
                        @if(!is_null($cal->calificacion))
                            @php $c = $cal->calificacion; @endphp
                            <span style="
                                display:inline-flex;align-items:center;justify-content:center;
                                width:48px;height:48px;border-radius:50%;font-weight:700;font-size:1rem;
                                background:{{ $c >= 7 ? '#d1fae5' : ($c >= 6 ? '#fef3c7' : '#fee2e2') }};
                                color:{{ $c >= 7 ? '#059669' : ($c >= 6 ? '#d97706' : '#dc2626') }};">
                                {{ number_format($c, 1) }}
                            </span>
                        @else
                            <span style="color:var(--muted)">—</span>
                        @endif
                    </td>

                    @if(Auth::user()->rol === 'maestro')
                    <td data-label="Acciones" style="text-align:center">
                        <div style="display:flex;justify-content:center;gap:6px">
                            <a href="{{ route('calificaciones.show', $cal) }}" class="btn-icon btn-icon-blue" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('calificaciones.edit', $cal) }}" class="btn-icon btn-icon-amber" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('calificaciones.destroy', $cal) }}" method="POST" style="display:inline"
                                  onclick="confirmarEliminar(this.action, '¿Eliminar esta calificación?'); return false;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon-red" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:var(--muted);padding:40px">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px"></i>
                        No hay calificaciones registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(method_exists($calificaciones, 'links'))
<div style="margin-top:16px">{{ $calificaciones->links() }}</div>
@endif
@endsection