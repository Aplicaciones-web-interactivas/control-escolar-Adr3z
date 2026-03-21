@extends('layouts.app')
@section('titulo', 'Nuevo Horario')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-plus-circle-fill" style="color:var(--accent)"></i> Nuevo Horario</h1>
    <a href="{{ route('horarios.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:680px">
    <div class="card-dark-header">
        <i class="bi bi-clock-fill" style="color:var(--accent)"></i> Datos del Horario
    </div>
    <div class="card-dark-body">
        <form action="{{ route('horarios.store') }}" method="POST">
            @csrf
            @php $horario = null; @endphp
            @include('horarios._form')
            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-check-lg"></i> Guardar Horario
                </button>
                <a href="{{ route('horarios.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection