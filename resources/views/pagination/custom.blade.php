@if ($paginator->hasPages())
<div style="display:flex;align-items:center;justify-content:space-between;margin-top:16px;flex-wrap:wrap;gap:8px">

    {{-- Info: "Mostrando X - Y de Z" --}}
    <span style="font-size:.8rem;color:var(--muted)">
        Mostrando
        <strong style="color:var(--text)">{{ $paginator->firstItem() }}</strong>
        –
        <strong style="color:var(--text)">{{ $paginator->lastItem() }}</strong>
        de
        <strong style="color:var(--text)">{{ $paginator->total() }}</strong>
        resultados
    </span>

    {{-- Botones --}}
    <div style="display:flex;gap:4px;align-items:center">

        {{-- Anterior --}}
        @if ($paginator->onFirstPage())
            <span style="
                display:inline-flex;align-items:center;justify-content:center;
                width:34px;height:34px;border-radius:8px;
                border:1px solid var(--border);
                color:var(--border);cursor:not-allowed;font-size:.85rem;
            ">
                <i class="bi bi-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="
                display:inline-flex;align-items:center;justify-content:center;
                width:34px;height:34px;border-radius:8px;
                border:1px solid var(--border);
                color:var(--muted);text-decoration:none;font-size:.85rem;
                transition:border-color .15s,color .15s;
            " onmouseover="this.style.borderColor='#64748b';this.style.color='var(--text)'"
               onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--muted)'">
                <i class="bi bi-chevron-left"></i>
            </a>
        @endif

        {{-- Números de página --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="
                    display:inline-flex;align-items:center;justify-content:center;
                    width:34px;height:34px;border-radius:8px;
                    color:var(--muted);font-size:.85rem;letter-spacing:.05em;
                ">…</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="
                            display:inline-flex;align-items:center;justify-content:center;
                            width:34px;height:34px;border-radius:8px;
                            background:var(--accent);color:#fff;
                            font-size:.85rem;font-weight:600;
                        ">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="
                            display:inline-flex;align-items:center;justify-content:center;
                            width:34px;height:34px;border-radius:8px;
                            border:1px solid var(--border);
                            color:var(--muted);text-decoration:none;font-size:.85rem;
                            transition:border-color .15s,color .15s;
                        " onmouseover="this.style.borderColor='#64748b';this.style.color='var(--text)'"
                           onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--muted)'">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Siguiente --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="
                display:inline-flex;align-items:center;justify-content:center;
                width:34px;height:34px;border-radius:8px;
                border:1px solid var(--border);
                color:var(--muted);text-decoration:none;font-size:.85rem;
                transition:border-color .15s,color .15s;
            " onmouseover="this.style.borderColor='#64748b';this.style.color='var(--text)'"
               onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--muted)'">
                <i class="bi bi-chevron-right"></i>
            </a>
        @else
            <span style="
                display:inline-flex;align-items:center;justify-content:center;
                width:34px;height:34px;border-radius:8px;
                border:1px solid var(--border);
                color:var(--border);cursor:not-allowed;font-size:.85rem;
            ">
                <i class="bi bi-chevron-right"></i>
            </span>
        @endif

    </div>
</div>
@endif