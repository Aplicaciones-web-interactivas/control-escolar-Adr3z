@extends('layouts.app')
@section('titulo', 'Nueva Calificación')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-plus-circle-fill" style="color:var(--accent)"></i> Nueva Calificación</h1>
    <a href="{{ route('calificaciones.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card-dark" style="max-width:580px">
    <div class="card-dark-header">
        <i class="bi bi-star-fill" style="color:var(--accent)"></i> Datos de la Calificación
    </div>
    <div class="card-dark-body">

        @if($errors->any())
            <div class="alert-error-dark" style="margin-bottom:20px">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('calificaciones.store') }}" method="POST">
            @csrf
            <div style="display:grid;gap:20px">

                {{-- Grupo --}}
                <div>
                    <label class="form-label-dark">Grupo</label>
                    <select name="grupo_id" id="grupo_id" class="form-select-dark {{ $errors->has('grupo_id') ? 'is-invalid' : '' }}" required>
                        <option value="">— Selecciona un grupo —</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                {{ $grupo->nombre }} — {{ $grupo->horario->materia->nombre ?? '?' }}
                            </option>
                        @endforeach
                    </select>
                    @error('grupo_id')<div class="invalid-msg">{{ $message }}</div>@enderror
                </div>

                {{-- Alumno (se carga dinámicamente) --}}
                <div>
                    <label class="form-label-dark">Alumno</label>
                    <select name="usuario_id" id="usuario_id" class="form-select-dark {{ $errors->has('usuario_id') ? 'is-invalid' : '' }}" required disabled>
                        <option value="">— Primero selecciona un grupo —</option>
                    </select>
                    @error('usuario_id')<div class="invalid-msg">{{ $message }}</div>@enderror
                </div>

                {{-- Calificación --}}
                <div>
                    <label class="form-label-dark">Calificación <span style="color:var(--muted);font-weight:400;text-transform:none;letter-spacing:0">(0 – 10)</span></label>
                    <input type="number" name="calificacion" step="0.01" min="0" max="10"
                           class="form-control-dark {{ $errors->has('calificacion') ? 'is-invalid' : '' }}"
                           value="{{ old('calificacion') }}"
                           placeholder="Ej. 8.5" required>
                    @error('calificacion')<div class="invalid-msg">{{ $message }}</div>@enderror
                </div>

            </div>

            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-check-lg"></i> Guardar Calificación
                </button>
                <a href="{{ route('calificaciones.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('grupo_id').addEventListener('change', function () {
        const grupoId = this.value;
        const select  = document.getElementById('usuario_id');

        select.innerHTML = '<option value="">Cargando...</option>';
        select.disabled  = true;

        if (!grupoId) {
            select.innerHTML = '<option value="">— Primero selecciona un grupo —</option>';
            return;
        }

        fetch(`/calificaciones/alumnos/${grupoId}`)
            .then(r => r.json())
            .then(alumnos => {
                if (alumnos.length === 0) {
                    select.innerHTML = '<option value="">Sin alumnos inscritos en este grupo</option>';
                    return;
                }
                select.innerHTML = '<option value="">— Selecciona un alumno —</option>';
                alumnos.forEach(a => {
                    select.innerHTML += `<option value="${a.id}">${a.nombre} — ${a.clave}</option>`;
                });
                select.disabled = false;
            })
            .catch(() => {
                select.innerHTML = '<option value="">Error al cargar alumnos</option>';
            });
    });
</script>
@endsection