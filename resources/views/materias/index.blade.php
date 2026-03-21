@extends('layouts.app')
@section('titulo', 'Materias')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-book-fill" style="color:var(--accent2)"></i> Materias</h1>
    <a href="{{ route('materias.create') }}" class="btn-accent">
        <i class="bi bi-plus-lg"></i> Nueva Materia
    </a>
</div>

<div class="card-dark">
    <div class="table-responsive">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Clave</th>
                    <th style="text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materias as $materia)
                <tr>
                    <td style="color:var(--muted)">{{ $materia->id }}</td>
                    <td style="font-weight:600">{{ $materia->nombre }}</td>
                    <td><code>{{ $materia->clave }}</code></td>
                    <td style="text-align:center">
                        <div style="display:flex;justify-content:center;gap:6px">
                            <a href="{{ route('materias.show', $materia) }}" class="btn-icon btn-icon-blue" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('materias.edit', $materia) }}" class="btn-icon btn-icon-amber" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('materias.destroy', $materia) }}" method="POST" style="display:inline"
                                  onclick="confirmarEliminar(this.action, '¿Eliminar esta materia? Esta acción no se puede deshacer.'); return false;">
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
                    <td colspan="4" style="text-align:center;color:var(--muted);padding:40px">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px"></i>
                        No hay materias registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(method_exists($materias, 'links'))
<div style="margin-top:16px">{{ $materias->links() }}</div>
@endif
@endsection