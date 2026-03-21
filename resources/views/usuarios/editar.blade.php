@extends('layouts.app')
@section('titulo', 'Editar Usuario')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-pencil-fill" style="color:#fbbf24"></i> Editar Usuario</h1>
    <a href="{{ route('usuarios.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:680px">
    <div class="card-dark-header">
        <i class="bi bi-person-fill" style="color:#fbbf24"></i> {{ $usuario->nombre }}
    </div>
    <div class="card-dark-body">
        <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
            @csrf @method('PUT')
            @include('usuarios._form')
            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-save"></i> Actualizar
                </button>
                <a href="{{ route('usuarios.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection