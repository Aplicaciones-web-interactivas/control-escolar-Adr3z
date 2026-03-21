<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Escolar — @yield('titulo', 'Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg:       #f1f5f9;
            --surface:  #ffffff;
            --border:   #e2e8f0;
            --accent:   #6c63ff;
            --accent2:  #0891b2;
            --text:     #1e293b;
            --muted:    #64748b;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand span {
            font-size: 1.1rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-brand small {
            display: block;
            color: var(--muted);
            font-size: 0.7rem;
            margin-top: 2px;
        }

        .nav-section {
            padding: 16px 12px 6px;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--muted);
            font-weight: 600;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            margin: 2px 8px;
            border-radius: 8px;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all .15s;
        }

        .sidebar-link i { font-size: 1rem; }

        .sidebar-link:hover {
            background: rgba(108, 99, 255, .12);
            color: var(--text);
        }

        .sidebar-link.active {
            background: rgba(108, 99, 255, .18);
            color: var(--accent);
        }

        /* ── Main ── */
        .main-wrap {
            margin-left: 240px;
            flex: 1;
            padding: 32px;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
            margin: 0;
        }

        /* ── Cards ── */
        .card-dark {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .card-dark-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-dark-body { padding: 20px; }

        /* ── Table ── */
        .table-dark-custom {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .table-dark-custom thead th {
            background: #f8fafc;
            color: var(--muted);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 600;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
        }

        .table-dark-custom tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .1s;
        }

        .table-dark-custom tbody tr:hover { background: #f8fafc; }
        .table-dark-custom tbody tr:last-child { border-bottom: none; }
        .table-dark-custom tbody td { padding: 13px 16px; color: var(--text); }

        /* ── Badges ── */
        .badge-role {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .badge-admin    { background: #fee2e2; color: #dc2626; }
        .badge-maestro  { background: #ede9fe; color: #7c3aed; }
        .badge-alumno   { background: #f1f5f9; color: #475569; }
        .badge-activo   { background: #d1fae5; color: #059669; }
        .badge-inactivo { background: #fee2e2; color: #dc2626; }

        /* ── Buttons ── */
        .btn-accent {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity .15s;
        }

        .btn-accent:hover { opacity: .85; color: #fff; }

        .btn-ghost {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .15s;
        }

        .btn-ghost:hover { border-color: #64748b; color: var(--text); }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; height: 32px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            transition: background .15s;
            text-decoration: none;
        }

        .btn-icon-blue  { background: rgba(59,130,246,.12); color: #60a5fa; }
        .btn-icon-blue:hover  { background: rgba(59,130,246,.25); color: #60a5fa; }
        .btn-icon-amber { background: rgba(245,158,11,.12); color: #fbbf24; }
        .btn-icon-amber:hover { background: rgba(245,158,11,.25); color: #fbbf24; }
        .btn-icon-red   { background: rgba(239,68,68,.12);  color: #f87171; }
        .btn-icon-red:hover   { background: rgba(239,68,68,.25);  color: #f87171; }

        /* ── Forms ── */
        .form-label-dark {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .form-control-dark, .form-select-dark {
            width: 100%;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            padding: 10px 14px;
            font-size: 0.875rem;
            transition: border-color .15s;
            outline: none;
        }

        .form-control-dark:focus, .form-select-dark:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(108,99,255,.15);
        }

        .form-control-dark::placeholder { color: var(--muted); }
        .form-select-dark option { background: #ffffff; }

        .form-control-dark.is-invalid, .form-select-dark.is-invalid {
            border-color: #f87171;
        }

        .invalid-msg { color: #f87171; font-size: 0.78rem; margin-top: 4px; }

        /* ── Checkbox days ── */
        .day-check { display: flex; flex-wrap: wrap; gap: 8px; }

        .day-check label {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid var(--border);
            font-size: 0.8rem;
            color: var(--muted);
            cursor: pointer;
            transition: all .15s;
        }

        .day-check input[type=checkbox] { display: none; }

        .day-check input[type=checkbox]:checked + span,
        .day-check label:has(input:checked) {
            background: rgba(108,99,255,.18);
            border-color: var(--accent);
            color: var(--accent);
        }

        /* ── Alert ── */
        .alert-success-dark {
            background: rgba(0,212,170,.1);
            border-left: 3px solid var(--accent2);
            color: var(--accent2);
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 20px;
        }

        .alert-error-dark {
            background: rgba(239,68,68,.1);
            border-left: 3px solid #f87171;
            color: #f87171;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 20px;
        }

        /* ── Detail rows ── */
        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { width: 160px; color: var(--muted); font-weight: 500; }
        .detail-value { color: var(--text); }

        code {
            background: #ede9fe;
            color: #7c3aed;
            padding: 2px 7px;
            border-radius: 5px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

{{-- Sidebar --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <span><i class="bi bi-mortarboard-fill"></i> Control Escolar</span>
        <small>Sistema de Gestión</small>
    </div>

    <div class="nav-section">Módulos</div>

    <a href="{{ route('usuarios.index') }}"
       class="sidebar-link {{ request()->is('usuarios*') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i> Usuarios
    </a>
    <a href="{{ route('materias.index') }}"
       class="sidebar-link {{ request()->is('materias*') ? 'active' : '' }}">
        <i class="bi bi-book-fill"></i> Materias
    </a>
    <a href="{{ route('horarios.index') }}"
       class="sidebar-link {{ request()->is('horarios*') ? 'active' : '' }}">
        <i class="bi bi-clock-fill"></i> Horarios
    </a>
</aside>

{{-- Main --}}
<main class="main-wrap">

    @if(session('exito'))
        <div class="alert-success-dark">
            <i class="bi bi-check-circle-fill"></i> {{ session('exito') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error-dark">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('contenido')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Toggle visual de checkboxes de días
    document.querySelectorAll('.day-check label').forEach(label => {
        label.addEventListener('click', () => {
            setTimeout(() => {
                const checked = label.querySelector('input[type=checkbox]').checked;
                label.style.background   = checked ? 'rgba(108,99,255,.18)' : '';
                label.style.borderColor  = checked ? 'var(--accent)'        : '';
                label.style.color        = checked ? 'var(--accent)'        : '';
            }, 0);
        });

        // Estado inicial
        const cb = label.querySelector('input[type=checkbox]');
        if (cb && cb.checked) {
            label.style.background  = 'rgba(108,99,255,.18)';
            label.style.borderColor = 'var(--accent)';
            label.style.color       = 'var(--accent)';
        }
    });
</script>
</body>
</html>