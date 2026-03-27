@extends('layouts.app')
@section('titulo', 'Horarios')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-clock-fill" style="color:var(--accent)"></i> Horarios</h1>
    @if(Auth::user()->rol === 'maestro')
    <a href="{{ route('horarios.create') }}" class="btn-accent">
        <i class="bi bi-plus-lg"></i> Nuevo Horario
    </a>
    @endif
</div>

<div class="card-dark">
    <div class="table-responsive">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Materia</th>
                    <th>Maestro</th>
                    <th>Días</th>
                    <th style="text-align:center">Hora Inicio</th>
                    <th style="text-align:center">Hora Fin</th>
                    @if(Auth::user()->rol === 'maestro')
                    <th style="text-align:center">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($horarios as $horario)
                    <tr>
                        <td data-label="#" style="color:var(--muted)">{{ $horario->id }}</td>
                        <td data-label="Materia">
                            <span style="font-weight:600;display:block">{{ $horario->materia->nombre ?? '—' }}</span>
                            <code style="font-size:.7rem">{{ $horario->materia->clave ?? '' }}</code>
                        </td>
                        <td data-label="Maestro">{{ $horario->usuario->nombre ?? '—' }}</td>
                        <td data-label="Días" style="color:var(--muted)">
                            {{ is_array($horario->dias) ? implode(', ', $horario->dias) : $horario->dias }}
                        </td>
                        <td data-label="Inicio" style="text-align:center"><code>{{ $horario->hora_inicio }}</code></td>
                        <td data-label="Fin" style="text-align:center"><code>{{ $horario->hora_fin }}</code></td>
                        
                        @if(Auth::user()->rol === 'maestro')
                        <td data-label="Acciones" style="text-align:center">
                            <div style="display:flex;justify-content:center;gap:6px">
                                <a href="{{ route('horarios.show', $horario) }}" class="btn-icon btn-icon-blue"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('horarios.edit', $horario) }}" class="btn-icon btn-icon-amber"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('horarios.destroy', $horario) }}" method="POST" style="display:inline"
                                    onclick="confirmarEliminar(this.action, '¿Eliminar este horario?'); return false;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-icon-red"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:var(--muted);padding:40px">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px"></i>
                        No hay horarios registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(method_exists($horarios, 'links'))
<div style="margin-top:16px">{{ $horarios->links() }}</div>
@endif
@endsection