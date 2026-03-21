@extends('layouts.app')
@section('titulo', 'Nuevo Usuario')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-person-plus-fill" style="color:var(--accent)"></i> Nuevo Usuario</h1>
    <a href="{{ route('usuarios.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:680px">
    <div class="card-dark-header">
        <i class="bi bi-person-fill" style="color:var(--accent)"></i> Datos del Usuario
    </div>
    <div class="card-dark-body">
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            @include('usuarios._form')
            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-check-lg"></i> Guardar Usuario
                </button>
                <a href="{{ route('usuarios.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection