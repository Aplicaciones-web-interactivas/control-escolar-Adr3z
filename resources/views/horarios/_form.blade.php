<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">

    {{-- Materia --}}
    <div>
        <label class="form-label-dark">Materia</label>
        <select name="materia_id" class="form-select-dark {{ $errors->has('materia_id') ? 'is-invalid' : '' }}" required>
            <option value="">— Selecciona una materia —</option>
            @foreach($materias as $materia)
                <option value="{{ $materia->id }}"
                    {{ old('materia_id', $horario->materia_id ?? '') == $materia->id ? 'selected' : '' }}>
                    {{ $materia->nombre }} ({{ $materia->clave }})
                </option>
            @endforeach
        </select>
        @error('materia_id')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    {{-- Maestro --}}
    <div>
        <label class="form-label-dark">Maestro</label>
        <select name="usuario_id" class="form-select-dark {{ $errors->has('usuario_id') ? 'is-invalid' : '' }}" required>
            <option value="">— Selecciona un maestro —</option>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}"
                    {{ old('usuario_id', $horario->usuario_id ?? '') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nombre }}
                </option>
            @endforeach
        </select>
        @error('usuario_id')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    {{-- Hora inicio --}}
    <div>
        <label class="form-label-dark">Hora Inicio</label>
        <input type="time" name="hora_inicio"
               class="form-control-dark {{ $errors->has('hora_inicio') ? 'is-invalid' : '' }}"
               value="{{ old('hora_inicio', $horario->hora_inicio ?? '') }}" required>
        @error('hora_inicio')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    {{-- Hora fin --}}
    <div>
        <label class="form-label-dark">Hora Fin</label>
        <input type="time" name="hora_fin"
               class="form-control-dark {{ $errors->has('hora_fin') ? 'is-invalid' : '' }}"
               value="{{ old('hora_fin', $horario->hora_fin ?? '') }}" required>
        @error('hora_fin')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    {{-- Días --}}
    <div style="grid-column:1/-1">
        <label class="form-label-dark">Días</label>
        <div class="day-check">
            @php
                $diasActuales = old('dias', is_array($horario->dias ?? [])
                    ? ($horario->dias ?? [])
                    : explode(', ', $horario->dias ?? ''));
            @endphp
            @foreach(['lunes','martes','miercoles','jueves','viernes','sabado'] as $dia)
                <label>
                    <input type="checkbox" name="dias[]" value="{{ $dia }}"
                           {{ in_array($dia, $diasActuales) ? 'checked' : '' }}>
                    <span>{{ ucfirst($dia) }}</span>
                </label>
            @endforeach
        </div>
        @error('dias')<div class="invalid-msg mt-1">{{ $message }}</div>@enderror
    </div>

</div>