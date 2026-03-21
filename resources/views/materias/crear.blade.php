@extends('layouts.app')
@section('titulo', 'Nueva Materia')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-plus-circle-fill" style="color:var(--accent2)"></i> Nueva Materia</h1>
    <a href="{{ route('materias.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:480px">
    <div class="card-dark-header">
        <i class="bi bi-book-fill" style="color:var(--accent2)"></i> Datos de la Materia
    </div>
    <div class="card-dark-body">
        <form action="{{ route('materias.store') }}" method="POST">
            @csrf
            @include('materias._form')
            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-check-lg"></i> Guardar
                </button>
                <a href="{{ route('materias.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection