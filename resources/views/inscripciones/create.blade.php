@extends('layouts.app')
@section('titulo', 'Nueva Inscripción')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-person-plus-fill" style="color:var(--accent)"></i> Nueva Inscripción</h1>
    <a href="{{ route('inscripciones.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:580px">
    <div class="card-dark-header">
        <i class="bi bi-person-check-fill" style="color:var(--accent)"></i> Datos de la Inscripción
    </div>
    <div class="card-dark-body">

        @if($errors->any())
            <div class="alert-error-dark" style="margin-bottom:20px">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inscripciones.store') }}" method="POST">
            @csrf
            <div style="display:grid;gap:20px">

                {{-- Alumno --}}
                <div>
                    <label class="form-label-dark">Alumno</label>
                    <select name="usuario_id" class="form-select-dark {{ $errors->has('usuario_id') ? 'is-invalid' : '' }}" required>
                        <option value="">— Selecciona un alumno —</option>
                        @foreach($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" {{ old('usuario_id') == $alumno->id ? 'selected' : '' }}>
                                {{ $alumno->nombre }} ({{ $alumno->clave_institucional }})
                            </option>
                        @endforeach
                    </select>
                    @error('usuario_id')<div class="invalid-msg">{{ $message }}</div>@enderror
                </div>

                {{-- Grupo --}}
                <div>
                    <label class="form-label-dark">Grupo</label>
                    <select name="grupo_id" class="form-select-dark {{ $errors->has('grupo_id') ? 'is-invalid' : '' }}" required>
                        <option value="">— Selecciona un grupo —</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                {{ $grupo->nombre }}
                                — {{ $grupo->horario->materia->nombre ?? '?' }}
                                ({{ $grupo->horario->hora_inicio ?? '' }}–{{ $grupo->horario->hora_fin ?? '' }})
                            </option>
                        @endforeach
                    </select>
                    @error('grupo_id')<div class="invalid-msg">{{ $message }}</div>@enderror
                </div>

            </div>

            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-check-lg"></i> Inscribir Alumno
                </button>
                <a href="{{ route('inscripciones.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection