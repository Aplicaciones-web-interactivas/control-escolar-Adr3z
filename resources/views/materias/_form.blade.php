<div style="display:grid;gap:20px">

    <div>
        <label class="form-label-dark">Nombre de la materia</label>
        <input type="text" name="nombre"
               class="form-control-dark {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
               value="{{ old('nombre', $materia->nombre ?? '') }}"
               placeholder="Ej. Cálculo Diferencial" required>
        @error('nombre')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    <div>
        <label class="form-label-dark">Clave</label>
        <input type="text" name="clave"
               class="form-control-dark {{ $errors->has('clave') ? 'is-invalid' : '' }}"
               value="{{ old('clave', $materia->clave ?? '') }}"
               placeholder="Ej. MAT101" required>
        @error('clave')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

</div>