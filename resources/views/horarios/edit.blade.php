@extends('layouts.app')
@section('titulo', 'Editar Horario')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-pencil-fill" style="color:#fbbf24"></i> Editar Horario</h1>
    <a href="{{ route('horarios.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:680px">
    <div class="card-dark-header">
        <i class="bi bi-clock-fill" style="color:#fbbf24"></i>
        {{ $horario->materia->nombre ?? 'Horario' }} — <code>{{ $horario->hora_inicio }} – {{ $horario->hora_fin }}</code>
    </div>
    <div class="card-dark-body">
        <form action="{{ route('horarios.update', $horario) }}" method="POST">
            @csrf @method('PUT')
            @include('horarios._form')
            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-save"></i> Actualizar
                </button>
                <a href="{{ route('horarios.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection