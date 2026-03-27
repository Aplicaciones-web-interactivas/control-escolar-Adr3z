@extends('layouts.app')
@section('titulo', 'Mis Tareas')

@section('contenido')
<div class="topbar">
    <h1 class="page-title"><i class="bi bi-journal-check" style="color:var(--accent)"></i> Mis Tareas</h1>
</div>

@forelse($tareas as $tarea)
@php
    $entrega  = $tarea->entregas->first();
@endphp

<div class="card-dark" style="margin-bottom:16px">
    <div class="card-dark-header" style="justify-content:space-between">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 10px;">
            <h3 style="margin:0; font-size:1.1rem">{{ $tarea->titulo }}</h3>
            <small style="color:var(--muted)">{{ $tarea->grupo->nombre }} · {{ $tarea->grupo->horario->materia->nombre ?? '?' }}</small>
        </div>
        <div style="display:flex;align-items:center;gap:10px">
            {{-- Fecha límite --}}
            <span style="font-size:.8rem;color:{{ $tarea->vencida ? '#dc2626' : '#059669' }}">
                <i class="bi bi-calendar{{ $tarea->vencida ? '-x' : '-check' }}"></i>
                {{ $tarea->fecha_entrega->format('d/m/Y') }}
                {{ $tarea->vencida ? '(vencida)' : '' }}
            </span>

        </div>
    </div>

    <div class="card-dark-body">
        @if($tarea->descripcion)
        <p style="color:var(--muted);font-size:.9rem;line-height:1.6;margin:0 0 16px;white-space:pre-wrap">{{ $tarea->descripcion }}</p>
        @endif

        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">

            {{-- Si ya entregó, mostrar que puede reemplazar el archivo --}}
            @if($entrega)
                <span style="font-size:.85rem;color:var(--muted)">
                    <i class="bi bi-file-earmark-pdf-fill" style="color:#dc2626"></i>
                    Entregado el {{ $entrega->created_at->format('d/m/Y H:i') }}
                </span>
            @endif

            {{-- Formulario de entrega disponible siempre --}}
            @if(!$tarea->vencida || $entrega)
            <form action="{{ route('alumno.tareas.subir', $tarea) }}" method="POST"
                  enctype="multipart/form-data"
                  style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">
                @csrf
                <label style="
                    display:inline-flex;align-items:center;gap:6px;
                    padding:7px 14px;border-radius:8px;
                    border:1px dashed var(--border);
                    color:var(--muted);font-size:.82rem;cursor:pointer;
                    transition:border-color .15s;
                " onmouseover="this.style.borderColor='var(--accent)'"
                   onmouseout="this.style.borderColor='var(--border)'">
                    <i class="bi bi-upload"></i>
                    <span id="label_{{ $tarea->id }}">{{ $entrega ? 'Reemplazar PDF' : 'Seleccionar PDF' }}</span>
                    <input type="file" name="archivo" accept=".pdf" style="display:none"
                           onchange="document.getElementById('label_{{ $tarea->id }}').textContent = this.files[0]?.name ?? '{{ $entrega ? 'Reemplazar PDF' : 'Seleccionar PDF' }}'">
                </label>
                <button type="submit" class="btn-accent" style="padding:7px 16px;font-size:.82rem">
                    <i class="bi bi-cloud-upload"></i> {{ $entrega ? 'Reemplazar entrega' : 'Subir entrega' }}
                </button>
            </form>
            @elseif($tarea->vencida && !$entrega)
                <span style="font-size:.85rem;color:#dc2626">
                    <i class="bi bi-lock-fill"></i> La fecha límite venció, ya no se aceptan entregas.
                </span>
            @endif

        </div>
    </div>
</div>

@empty
<div class="card-dark" style="text-align:center;padding:48px;color:var(--muted)">
    <i class="bi bi-inbox" style="font-size:2.5rem;display:block;margin-bottom:10px"></i>
    No tienes tareas asignadas.
</div>
@endforelse

@if(method_exists($tareas, 'links'))
<div style="margin-top:16px">{{ $tareas->links('pagination.custom') }}</div>
@endif
@endsection