<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">

    <div style="grid-column:1/-1">
        <label class="form-label-dark">Nombre completo</label>
        <input type="text" name="nombre"
               class="form-control-dark {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
               value="{{ old('nombre', $usuario->nombre ?? '') }}"
               placeholder="Ej. Juan García López" required>
        @error('nombre')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    <div>
        <label class="form-label-dark">Clave Institucional</label>
        <input type="text" name="clave_institucional"
               class="form-control-dark {{ $errors->has('clave_institucional') ? 'is-invalid' : '' }}"
               value="{{ old('clave_institucional', $usuario->clave_institucional ?? '') }}"
               placeholder="Ej. 2021CS001" required>
        @error('clave_institucional')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    <div>
        <label class="form-label-dark">Rol</label>
        <select name="rol" class="form-select-dark {{ $errors->has('rol') ? 'is-invalid' : '' }}" required>
            @foreach(['alumno', 'maestro', 'admin'] as $rol)
                <option value="{{ $rol }}" {{ old('rol', $usuario->rol ?? 'alumno') === $rol ? 'selected' : '' }}>
                    {{ ucfirst($rol) }}
                </option>
            @endforeach
        </select>
        @error('rol')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    <div style="grid-column:1/-1">
        <label class="form-label-dark">
            Contraseña
            @isset($usuario)
                <span style="color:var(--muted);font-weight:400;text-transform:none;letter-spacing:0">(dejar vacío para no cambiar)</span>
            @endisset
        </label>
        <input type="password" name="contrasena"
               class="form-control-dark {{ $errors->has('contrasena') ? 'is-invalid' : '' }}"
               placeholder="••••••••"
               {{ isset($usuario) ? '' : 'required' }}>
        @error('contrasena')<div class="invalid-msg">{{ $message }}</div>@enderror
    </div>

    <div style="grid-column:1/-1;display:flex;align-items:center;gap:10px">
        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-size:.875rem;color:#94a3b8">
            <input type="hidden" name="activo" value="0">
            <input type="checkbox" name="activo" value="1" id="activo"
                   {{ old('activo', $usuario->activo ?? true) ? 'checked' : '' }}
                   style="width:18px;height:18px;accent-color:var(--accent);cursor:pointer">
            Usuario activo
        </label>
    </div>

</div>