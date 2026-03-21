@extends('layouts.app')
@section('titulo', 'Usuarios')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-people-fill" style="color:var(--accent)"></i> Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn-accent">
        <i class="bi bi-plus-lg"></i> Nuevo Usuario
    </a>
</div>

<div class="card-dark">
    <div class="table-responsive">
        <table class="table-dark-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Clave Institucional</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th style="text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td style="color:var(--muted)">{{ $usuario->id }}</td>
                    <td style="font-weight:600">{{ $usuario->nombre }}</td>
                    <td><code>{{ $usuario->clave_institucional }}</code></td>
                    <td>
                        <span class="badge-role badge-{{ $usuario->rol }}">{{ ucfirst($usuario->rol) }}</span>
                    </td>
                    <td>
                        @if($usuario->activo)
                            <span class="badge-role badge-activo"><i class="bi bi-circle-fill me-1" style="font-size:.45rem"></i>Activo</span>
                        @else
                            <span class="badge-role badge-inactivo"><i class="bi bi-circle-fill me-1" style="font-size:.45rem"></i>Inactivo</span>
                        @endif
                    </td>
                    <td style="text-align:center">
                        <div style="display:flex;justify-content:center;gap:6px">
                            <a href="{{ route('usuarios.show', $usuario) }}" class="btn-icon btn-icon-blue" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('usuarios.edit', $usuario) }}" class="btn-icon btn-icon-amber" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" style="display:inline"
                                  onclick="confirmarEliminar(this.action, '¿Eliminar al usuario? Esta acción no se puede deshacer.'); return false;">
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
                    <td colspan="6" style="text-align:center;color:var(--muted);padding:40px">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px"></i>
                        No hay usuarios registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(method_exists($usuarios, 'links'))
<div style="margin-top:16px">{{ $usuarios->links() }}</div>
@endif
@endsection