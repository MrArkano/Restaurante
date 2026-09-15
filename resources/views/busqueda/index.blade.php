@extends('layouts.app')

@section('title', 'Búsqueda Avanzada')

@section('content')
<div class="space-y-8">
  <!-- Header de Sección -->
  <div class="pb-6 border-b border-zinc-800/80">
    <div class="flex items-center gap-2 text-primary text-xs font-semibold uppercase tracking-wider mb-1">
      <i data-lucide="search" class="w-3.5 h-3.5"></i>
      <span>Explorar Colección</span>
    </div>
    <h1 class="text-3xl font-extrabold tracking-tight text-white">Búsqueda Avanzada</h1>
    <p class="text-sm text-zinc-400 mt-1">Busca juegos de mesa y expansiones combinando distintos filtros.</p>
  </div>

  <!-- ==================== FORMULARIO DE BÚSQUEDA ==================== -->
  <form method="GET" action="{{ url('/busqueda') }}" class="rounded-2xl border border-zinc-800 bg-content1/80 p-6 space-y-5">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
      <!-- Campo: Nombre -->
      <div class="lg:col-span-2 space-y-2">
        <label for="q" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
          Nombre del juego o expansión
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
            <i data-lucide="type" class="w-4 h-4"></i>
          </div>
          <input
            type="text"
            id="q"
            name="q"
            value="{{ $q ?? '' }}"
            maxlength="100"
            placeholder="Ej. Catan, Navegantes, Dixit..."
            class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
          />
        </div>
        <p class="text-[11px] text-zinc-500">Búsqueda parcial: coincide al inicio, medio o final del nombre.</p>
      </div>

      <!-- Campo: Idioma -->
      <div class="space-y-2">
        <label for="idioma_id" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
          Idioma
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
            <i data-lucide="globe" class="w-4 h-4"></i>
          </div>
          <select
            id="idioma_id"
            name="idioma_id"
            class="w-full pl-10 pr-10 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all appearance-none cursor-pointer"
          >
            <option value="" class="bg-zinc-900 text-white">Todos los idiomas</option>
            @foreach($idiomas as $idioma)
              <option value="{{ $idioma->id }}" {{ ($idiomaId == $idioma->id) ? 'selected' : '' }} class="bg-zinc-900 text-white">
                {{ $idioma->nombre }} ({{ $idioma->codigo }})
              </option>
            @endforeach
          </select>
          <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-zinc-500">
            <i data-lucide="chevron-down" class="w-4 h-4"></i>
          </div>
        </div>
      </div>

      <!-- Placeholder para alinear -->
      <div class="hidden lg:block"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
      <!-- Campo: Año desde -->
      <div class="space-y-2">
        <label for="anio_desde" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
          Año desde
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
            <i data-lucide="calendar" class="w-4 h-4"></i>
          </div>
          <input
            type="number"
            id="anio_desde"
            name="anio_desde"
            value="{{ $anioDesde ?? '' }}"
            min="1900"
            max="2099"
            placeholder="Ej. 2015"
            class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
          />
        </div>
      </div>

      <!-- Campo: Año hasta -->
      <div class="space-y-2">
        <label for="anio_hasta" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
          Año hasta
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
            <i data-lucide="calendar" class="w-4 h-4"></i>
          </div>
          <input
            type="number"
            id="anio_hasta"
            name="anio_hasta"
            value="{{ $anioHasta ?? '' }}"
            min="1900"
            max="2099"
            placeholder="Ej. 2025"
            class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
          />
        </div>
      </div>

      <!-- Botones de acción -->
      <div class="lg:col-span-2 flex items-end gap-3">
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold bg-primary hover:bg-primary/90 text-white shadow-lg shadow-primary/25 active:scale-95 transition-all">
          <i data-lucide="search" class="w-4 h-4"></i>
          <span>Buscar</span>
        </button>

        <a href="{{ url('/busqueda') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-zinc-300 transition-all">
          <i data-lucide="x" class="w-4 h-4"></i>
          <span>Limpiar filtros</span>
        </a>
      </div>
    </div>

    <!-- Mostrar errores de validación -->
    @if($errors->any())
      <div class="p-4 rounded-xl bg-rose-950/40 border border-rose-600/40 text-rose-200 text-sm flex items-start gap-3">
        <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-400 flex-shrink-0 mt-0.5"></i>
        <div>
          @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      </div>
    @endif
  </form>

  <!-- ==================== RESULTADOS ==================== -->
  @if($hayFiltros)
    <div class="flex items-center justify-between">
      <p class="text-sm text-zinc-400">
        Se encontraron <span class="font-bold text-white">{{ $resultados->total() }}</span> {{ $resultados->total() === 1 ? 'resultado' : 'resultados' }}.
      </p>
    </div>
  @endif

  @if($resultados->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
      @foreach($resultados as $item)
        <div class="group relative rounded-2xl border border-zinc-800/80 bg-content1/80 hover:bg-content1 hover:border-zinc-700 transition-all duration-300 p-5 flex flex-col justify-between overflow-hidden hover:shadow-xl hover:shadow-primary/5">
          <div class="absolute -right-12 -top-12 w-32 h-32 {{ $item->es_juego ? 'bg-primary/10' : 'bg-purple-500/10' }} rounded-full blur-2xl group-hover:{{ $item->es_juego ? 'bg-primary/20' : 'bg-purple-500/20' }} transition-all"></div>

          <div>
            <!-- Badges -->
            <div class="flex flex-wrap items-center gap-2 mb-3">
              <!-- Tipo -->
              <span class="inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full {{ $item->es_juego ? 'bg-primary/15 text-primary border border-primary/25' : 'bg-purple-500/15 text-purple-400 border border-purple-500/25' }}">
                <i data-lucide="{{ $item->es_juego ? 'gamepad-2' : 'puzzle' }}" class="w-3 h-3"></i>
                {{ $item->tipo }}
              </span>

              <!-- Año -->
              @if($item->anio)
                <span class="inline-flex items-center gap-1 text-[11px] font-medium px-2 py-0.5 rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700/60">
                  <i data-lucide="calendar" class="w-3 h-3 text-zinc-400"></i>
                  {{ $item->anio }}
                </span>
              @endif

              <!-- Idioma -->
              <span class="inline-flex items-center gap-1 text-[11px] font-medium px-2 py-0.5 rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700/60">
                <i data-lucide="globe" class="w-3 h-3 text-zinc-400"></i>
                {{ $item->idioma }}
              </span>
            </div>

            <!-- Título -->
            <h3 class="text-lg font-bold text-white tracking-tight group-hover:text-primary transition-colors line-clamp-2 mb-1">
              {{ $item->titulo }}
            </h3>

            <!-- Juego Base (solo para expansiones) -->
            @if(!$item->es_juego && $item->juego_base)
              <p class="text-xs text-zinc-400 flex items-center gap-1.5 mt-1">
                <i data-lucide="link" class="w-3 h-3 text-zinc-500"></i>
                Juego base: <span class="font-semibold text-zinc-300">{{ $item->juego_base }}</span>
              </p>
            @endif
          </div>

          <!-- Enlace al detalle -->
          <div class="pt-3 mt-3 border-t border-zinc-800/70">
            @if($item->es_juego)
              <a href="{{ url('/juegos/' . $item->juego_id) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-300 hover:text-white px-3 py-1.5 rounded-lg hover:bg-zinc-800 transition-colors">
                <i data-lucide="eye" class="w-3.5 h-3.5 text-zinc-400"></i>
                <span>Ver detalle del juego</span>
              </a>
            @else
              <a href="{{ url('/juegos/' . $item->juego_id) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-300 hover:text-white px-3 py-1.5 rounded-lg hover:bg-zinc-800 transition-colors">
                <i data-lucide="eye" class="w-3.5 h-3.5 text-zinc-400"></i>
                <span>Ver juego base</span>
              </a>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    <!-- Paginación -->
    @if($resultados->hasPages())
      <div class="flex justify-center pt-4">
        <nav class="flex items-center gap-1">
          {{-- Anterior --}}
          @if($resultados->onFirstPage())
            <span class="px-3 py-2 rounded-lg text-xs font-medium text-zinc-600 bg-zinc-900 border border-zinc-800 cursor-not-allowed">
              <i data-lucide="chevron-left" class="w-4 h-4"></i>
            </span>
          @else
            <a href="{{ $resultados->previousPageUrl() }}" class="px-3 py-2 rounded-lg text-xs font-medium text-zinc-300 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 hover:border-zinc-700 transition-all">
              <i data-lucide="chevron-left" class="w-4 h-4"></i>
            </a>
          @endif

          {{-- Números de Página --}}
          @foreach($resultados->getUrlRange(1, $resultados->lastPage()) as $page => $url)
            @if($page == $resultados->currentPage())
              <span class="px-3.5 py-2 rounded-lg text-xs font-bold text-white bg-primary border border-primary shadow-md shadow-primary/20">
                {{ $page }}
              </span>
            @else
              <a href="{{ $url }}" class="px-3.5 py-2 rounded-lg text-xs font-medium text-zinc-300 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 hover:border-zinc-700 transition-all">
                {{ $page }}
              </a>
            @endif
          @endforeach

          {{-- Siguiente --}}
          @if($resultados->hasMorePages())
            <a href="{{ $resultados->nextPageUrl() }}" class="px-3 py-2 rounded-lg text-xs font-medium text-zinc-300 bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 hover:border-zinc-700 transition-all">
              <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
          @else
            <span class="px-3 py-2 rounded-lg text-xs font-medium text-zinc-600 bg-zinc-900 border border-zinc-800 cursor-not-allowed">
              <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </span>
          @endif
        </nav>
      </div>
    @endif

  @elseif($hayFiltros)
    <!-- Sin resultados -->
    <div class="text-center py-16 px-6 rounded-3xl border border-dashed border-zinc-800 bg-zinc-900/30 flex flex-col items-center justify-center">
      <div class="w-16 h-16 rounded-2xl bg-zinc-800 border border-zinc-700 text-zinc-500 flex items-center justify-center mb-4">
        <i data-lucide="search-x" class="w-8 h-8"></i>
      </div>
      <h3 class="text-lg font-bold text-white mb-2">No se encontraron resultados</h3>
      <p class="text-sm text-zinc-400 max-w-md mb-5">
        Intenta ajustando los filtros de búsqueda o utilizando términos más generales.
      </p>
      <a href="{{ url('/busqueda') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-zinc-200 transition-all">
        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5 inline mr-1"></i> Limpiar filtros
      </a>
    </div>
  @else
    <!-- Estado inicial (sin filtros) -->
    <div class="text-center py-16 px-6 rounded-3xl border border-dashed border-zinc-800 bg-zinc-900/30 flex flex-col items-center justify-center">
      <div class="w-16 h-16 rounded-2xl bg-primary/10 border border-primary/20 text-primary flex items-center justify-center mb-4">
        <i data-lucide="search" class="w-8 h-8"></i>
      </div>
      <h3 class="text-lg font-bold text-white mb-2">Comienza a buscar</h3>
      <p class="text-sm text-zinc-400 max-w-md">
        Utiliza los filtros de arriba para explorar tu colección de juegos de mesa y expansiones.
      </p>
    </div>
  @endif
</div>
@endsection