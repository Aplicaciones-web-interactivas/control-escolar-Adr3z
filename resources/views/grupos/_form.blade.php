<div style="display:grid;gap:20px">

    <div>
        <label class="form-label-dark">Nombre del Grupo</label>
        <input type="text" name="nombre"
               class="form-control-dark {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
               value="{{ old('nombre', $grupo->nombre ?? '') }}"
               placeholder="Ej. Grupo A, 3°B, Turno Matutino..." required>
        @error('nombre')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    <div>
        <label class="form-label-dark">Horario</label>
        <select name="horario_id" class="form-select-dark {{ $errors->has('horario_id') ? 'is-invalid' : '' }}" required>
            <option value="">— Selecciona un horario —</option>
            @foreach($horarios as $horario)
                <option value="{{ $horario->id }}"
                    {{ old('horario_id', $grupo->horario_id ?? '') == $horario->id ? 'selected' : '' }}>
                    {{ $horario->materia->nombre ?? '?' }}
                    — {{ is_array($horario->dias) ? implode(', ', $horario->dias) : $horario->dias }}
                    ({{ $horario->hora_inicio }} – {{ $horario->hora_fin }})
                    @if($horario->usuario)
                        · {{ $horario->usuario->nombre }}
                    @endif
                </option>
            @endforeach
        </select>
        @error('horario_id')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

</div>