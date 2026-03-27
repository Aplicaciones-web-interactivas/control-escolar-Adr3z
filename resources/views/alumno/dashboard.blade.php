@extends('layouts.app')
@section('titulo', 'Inicio')

@section('contenido')
<div class="topbar">
    <h1 class="page-title">¡Hola, {{ $alumno->nombre }}!</h1>
</div>

{{-- Tarjetas resumen --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px">
    <div class="card-dark" style="padding:20px;display:flex;align-items:center;gap:14px">
        <div style="width:44px;height:44px;background:#ede9fe;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#6c63ff;font-size:1.2rem;flex-shrink:0">
            <i class="bi bi-book-fill"></i>
        </div>
        <div>
            <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em">Materias</div>
            <div style="font-size:1.6rem;font-weight:800;color:var(--text)">{{ $materiasCount }}</div>
        </div>
    </div>
    <div class="card-dark" style="padding:20px;display:flex;align-items:center;gap:14px">
        <div style="width:44px;height:44px;background:#d1fae5;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#059669;font-size:1.2rem;flex-shrink:0">
            <i class="bi bi-collection-fill"></i>
        </div>
        <div>
            <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em">Mis Grupos</div>
            <div style="font-size:1.6rem;font-weight:800;color:var(--text)">{{ $misGrupos->count() }}</div>
        </div>
    </div>
    <div class="card-dark" style="padding:20px;display:flex;align-items:center;gap:14px">
        <div style="width:44px;height:44px;background:#fef3c7;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#d97706;font-size:1.2rem;flex-shrink:0">
            <i class="bi bi-star-fill"></i>
        </div>
        <div>
            <div style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em">Calificaciones</div>
            <div style="font-size:1.6rem;font-weight:800;color:var(--text)">{{ $misCalifs->count() }}</div>
        </div>
    </div>
</div>

{{-- Mis grupos inscritos --}}
<div class="card-dark">
    <div class="card-dark-header">
        <i class="bi bi-collection-fill" style="color:var(--accent)"></i> Mis Grupos Inscritos
    </div>
    <table class="table-dark-custom">
        <thead>
            <tr>
                <th>Materia</th>
                <th>Grupo</th>
                <th>Días</th>
                <th style="text-align:center">Horario</th>
                <th style="text-align:center">Calificación</th>
            </tr>
        </thead>
        <tbody>
            @forelse($misGrupos as $inscripcion)
            @php
                $grupo = $inscripcion->grupo;
                $horario = $grupo->horario ?? null;
                $calif = $misCalifs->firstWhere('grupo_id', $grupo->id);
            @endphp
            <tr>
                <td style="font-weight:600">{{ $horario->materia->nombre ?? '—' }}</td>
                <td>{{ $grupo->nombre }}</td>
                <td style="color:var(--muted)">{{ is_array($horario->dias ?? '') ? implode(', ', $horario->dias) : ($horario->dias ?? '—') }}</td>
                <td style="text-align:center"><code>{{ $horario->hora_inicio ?? '—' }} – {{ $horario->hora_fin ?? '' }}</code></td>
                <td style="text-align:center">
                    @if($calif && !is_null($calif->calificacion))
                        @php $c = $calif->calificacion; @endphp
                        <span style="display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;font-weight:700;font-size:.9rem;background:{{ $c >= 7 ? '#d1fae5' : ($c >= 6 ? '#fef3c7' : '#fee2e2') }};color:{{ $c >= 7 ? '#059669' : ($c >= 6 ? '#d97706' : '#dc2626') }}">
                            {{ number_format($c, 1) }}
                        </span>
                    @else
                        <span style="color:var(--muted);font-size:.8rem">Pendiente</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:var(--muted);padding:32px">
                    <i class="bi bi-inbox" style="font-size:1.5rem;display:block;margin-bottom:6px"></i>
                    No estás inscrito en ningún grupo.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection