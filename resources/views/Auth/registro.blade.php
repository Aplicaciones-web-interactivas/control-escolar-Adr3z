<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro — Control Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: #f1f5f9;
            font-family: 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 4px 24px rgba(0,0,0,.07);
        }
        .logo { text-align: center; margin-bottom: 28px; }
        .logo-icon {
            width: 56px; height: 56px;
            background: #d1fae5;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #059669;
            margin-bottom: 12px;
        }
        .logo h1 { font-size: 1.25rem; font-weight: 700; color: #1e293b; }
        .logo p  { font-size: .85rem; color: #64748b; margin-top: 4px; }
        .field { margin-bottom: 16px; }
        .field label {
            display: block;
            font-size: .78rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 6px;
        }
        .field input {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: .875rem;
            color: #1e293b;
            outline: none;
            transition: border-color .15s;
        }
        .field input:focus { border-color: #059669; box-shadow: 0 0 0 3px rgba(5,150,105,.12); }
        .field input.is-invalid { border-color: #dc2626; }
        .invalid-msg { color: #dc2626; font-size: .78rem; margin-top: 4px; }
        .error {
            background: #fee2e2;
            border-left: 3px solid #dc2626;
            color: #dc2626;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: .82rem;
            margin-bottom: 18px;
        }
        .note {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: .82rem;
            color: #166534;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn {
            width: 100%;
            background: #059669;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 11px;
            font-size: .9rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .15s;
            margin-top: 4px;
        }
        .btn:hover { opacity: .88; }
        .footer { text-align: center; margin-top: 20px; font-size: .83rem; color: #64748b; }
        .footer a { color: #6c63ff; text-decoration: none; font-weight: 600; }
        .footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">
        <div class="logo-icon"><i class="bi bi-person-plus-fill"></i></div>
        <h1>Crear Cuenta</h1>
        <p>Registro de alumno</p>
    </div>

    <div class="note">
        <i class="bi bi-info-circle-fill"></i>
        El registro público crea una cuenta de <strong>alumno</strong>.
    </div>

    @if($errors->any())
        <div class="error"><i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}</div>
    @endif

    <form action="{{ route('registro.post') }}" method="POST">
        @csrf
        <div class="field">
            <label>Nombre completo</label>
            <input type="text" name="nombre"
                   value="{{ old('nombre') }}"
                   class="{{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                   placeholder="Ej. Juan García López" required autofocus>
            @error('nombre')<div class="invalid-msg">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Clave Institucional</label>
            <input type="text" name="clave_institucional"
                   value="{{ old('clave_institucional') }}"
                   class="{{ $errors->has('clave_institucional') ? 'is-invalid' : '' }}"
                   placeholder="Ej. 2021CS001" required>
            @error('clave_institucional')<div class="invalid-msg">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Contraseña</label>
            <input type="password" name="contrasena"
                   class="{{ $errors->has('contrasena') ? 'is-invalid' : '' }}"
                   placeholder="Mínimo 6 caracteres" required>
            @error('contrasena')<div class="invalid-msg">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Confirmar Contraseña</label>
            <input type="password" name="contrasena_confirmation" placeholder="Repite tu contraseña" required>
        </div>
        <button type="submit" class="btn"><i class="bi bi-check-lg"></i> Crear Cuenta</button>
    </form>

    <div class="footer">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
    </div>
</div>
</body>
</html>