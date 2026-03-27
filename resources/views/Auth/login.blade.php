<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — Control Escolar</title>
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
        }
        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 24px rgba(0,0,0,.07);
        }
        .logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .logo-icon {
            width: 56px; height: 56px;
            background: #ede9fe;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #6c63ff;
            margin-bottom: 12px;
        }
        .logo h1 { font-size: 1.25rem; font-weight: 700; color: #1e293b; }
        .logo p  { font-size: .85rem; color: #64748b; margin-top: 4px; }
        .field { margin-bottom: 18px; }
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
        .field input:focus { border-color: #6c63ff; box-shadow: 0 0 0 3px rgba(108,99,255,.12); }
        .error {
            background: #fee2e2;
            border-left: 3px solid #dc2626;
            color: #dc2626;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: .82rem;
            margin-bottom: 18px;
        }
        .success {
            background: #d1fae5;
            border-left: 3px solid #059669;
            color: #059669;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: .82rem;
            margin-bottom: 18px;
        }
        .btn {
            width: 100%;
            background: #6c63ff;
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
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: .83rem;
            color: #64748b;
        }
        .footer a { color: #6c63ff; text-decoration: none; font-weight: 600; }
        .footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">
        <div class="logo-icon"><i class="bi bi-mortarboard-fill"></i></div>
        <h1>Control Escolar</h1>
        <p>Inicia sesión para continuar</p>
    </div>

    @if(session('exito'))
        <div class="success"><i class="bi bi-check-circle"></i> {{ session('exito') }}</div>
    @endif

    @if($errors->any())
        <div class="error"><i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="field">
            <label>Clave Institucional</label>
            <input type="text" name="clave_institucional"
                   value="{{ old('clave_institucional') }}"
                   placeholder="Ej. 2021CS001" autofocus required>
        </div>
        <div class="field">
            <label>Contraseña</label>
            <input type="password" name="contrasena" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn">Iniciar Sesión</button>
    </form>

    <div class="footer">
        ¿No tienes cuenta? <a href="{{ route('registro') }}">Regístrate</a>
    </div>
</div>
</body>
</html>