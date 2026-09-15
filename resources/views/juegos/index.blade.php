@extends('layouts.app')

@section('title', 'Catálogo de Juegos')

@section('content')
<div class="space-y-8">
  <!-- Header de Sección -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-zinc-800/80">
    <div>
      <div class="flex items-center gap-2 text-primary text-xs font-semibold uppercase tracking-wider mb-1">
        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
        <span>Colección Principal</span>
      </div>
      <h1 class="text-3xl font-extrabold tracking-tight text-white flex items-center gap-3">
        Catálogo de Juegos
        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-zinc-800 border border-zinc-700 text-zinc-300">
          {{ count($juegos) }} {{ count($juegos) === 1 ? 'juego' : 'juegos' }}
        </span>
      </h1>
      <p class="text-sm text-zinc-400 mt-1">Explora todos los juegos de mesa disponibles y sus expansiones.</p>
    </div>

    <div class="flex items-center gap-3">
      <a href="{{ url('/idiomas/create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold bg-zinc-900 hover:bg-zinc-800 border border-zinc-800 text-zinc-300 transition-all hover:border-zinc-700">
        <i data-lucide="globe" class="w-4 h-4 text-zinc-400"></i>
        <span>Idiomas</span>
      </a>

      <a href="{{ url('/expansiones/create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold bg-zinc-900 hover:bg-zinc-800 border border-zinc-800 text-zinc-300 transition-all hover:border-zinc-700">
        <i data-lucide="puzzle" class="w-4 h-4 text-purple-400"></i>
        <span>Nueva Expansión</span>
      </a>

      <a href="{{ url('/juegos/create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-semibold bg-primary hover:bg-primary/90 text-white shadow-lg shadow-primary/25 active:scale-95 transition-all">
        <i data-lucide="plus" class="w-4 h-4"></i>
        <span>Nuevo Juego</span>
      </a>
    </div>
  </div>

  @if(count($juegos) === 0)
    <!-- Estado vacío -->
    <div class="text-center py-20 px-6 rounded-3xl border border-dashed border-zinc-800 bg-zinc-900/30 flex flex-col items-center justify-center">
      <div class="w-16 h-16 rounded-2xl bg-primary/10 border border-primary/20 text-primary flex items-center justify-center mb-4">
        <i data-lucide="inbox" class="w-8 h-8"></i>
      </div>
      <h3 class="text-lg font-bold text-white mb-2">No hay juegos registrados todavía</h3>
      <p class="text-sm text-zinc-400 max-w-md mb-6">
        Comienza agregando los idiomas que utilizas y luego registra tu primer juego de mesa.
      </p>
      <div class="flex flex-wrap items-center justify-center gap-3">
        <a href="{{ url('/idiomas/create') }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-zinc-200 transition-all">
          <i data-lucide="globe" class="w-3.5 h-3.5 inline mr-1"></i> Registrar Idioma
        </a>
        <a href="{{ url('/juegos/create') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold bg-primary hover:bg-primary/90 text-white shadow-lg shadow-primary/25 transition-all">
          <i data-lucide="plus" class="w-3.5 h-3.5 inline mr-1"></i> Registrar Primer Juego
        </a>
      </div>
    </div>
  @else
    <!-- Grilla de Juegos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($juegos as $juego)
        <div id="juego-card-{{ $juego->id }}" class="group relative rounded-2xl border border-zinc-800/80 bg-content1/80 hover:bg-content1 hover:border-zinc-700 transition-all duration-300 p-6 flex flex-col justify-between overflow-hidden hover:shadow-xl hover:shadow-primary/5">
          <!-- Brillo de fondo al hacer hover -->
          <div class="absolute -right-12 -top-12 w-32 h-32 bg-primary/10 rounded-full blur-2xl group-hover:bg-primary/20 transition-all"></div>

          <div>
            <!-- Header de la tarjeta con badge de año e idioma -->
            <div class="flex items-center justify-between gap-2 mb-4">
              <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full bg-zinc-800/90 text-zinc-300 border border-zinc-700/60">
                <i data-lucide="calendar" class="w-3 h-3 text-zinc-400"></i>
                Año {{ $juego->anio }}
              </span>

              <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full bg-primary/10 text-primary border border-primary/20">
                <i data-lucide="globe" class="w-3 h-3"></i>
                {{ $juego->idioma->nombre ?? $juego->idioma ?? 'Sin idioma' }}
              </span>
            </div>

            <!-- Título del juego -->
            <h3 class="text-xl font-bold text-white tracking-tight group-hover:text-primary transition-colors line-clamp-2 mb-2">
              <a href="{{ url('/juegos/' . $juego->id) }}">
                {{ $juego->titulo }}
              </a>
            </h3>

            <p class="text-xs text-zinc-400 flex items-center gap-1 mb-6">
              <i data-lucide="hash" class="w-3.5 h-3.5 text-zinc-500"></i>
              ID Juego: <span class="font-mono text-zinc-300">{{ $juego->id }}</span>
            </p>
          </div>

          <!-- Acciones -->
          <div class="pt-4 border-t border-zinc-800/70 flex items-center justify-between gap-2">
            <a href="{{ url('/juegos/' . $juego->id) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-300 hover:text-white px-3 py-1.5 rounded-lg hover:bg-zinc-800 transition-colors">
              <i data-lucide="eye" class="w-3.5 h-3.5 text-zinc-400"></i>
              <span>Ver detalle</span>
            </a>

            <div class="flex items-center gap-1.5">
              <a href="{{ url('/expansiones/create?juego_id=' . $juego->id) }}" title="Añadir expansión a este juego" class="p-2 rounded-lg text-purple-400 hover:text-purple-300 hover:bg-purple-950/40 border border-transparent hover:border-purple-800/50 transition-colors">
                <i data-lucide="puzzle" class="w-4 h-4"></i>
              </a>

              <button onclick="eliminarJuego({{ $juego->id }}, '{{ addslashes($juego->titulo) }}')" title="Eliminar juego" class="p-2 rounded-lg text-zinc-500 hover:text-rose-400 hover:bg-rose-950/30 border border-transparent hover:border-rose-900/50 transition-colors">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
              </button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
  async function eliminarJuego(id, titulo) {
    if (!confirm(`¿Estás seguro de eliminar el juego "${titulo}"?\nSe eliminarán también las expansiones asociadas.`)) {
      return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
      const response = await fetch(`{{ url('/juegos') }}/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      });

      const data = await response.json();

      if (response.ok) {
        showToast(data.message || 'Juego eliminado correctamente', 'success');
        const card = document.getElementById(`juego-card-${id}`);
        if (card) {
          card.style.transition = 'all 0.4s ease';
          card.style.opacity = '0';
          card.style.transform = 'scale(0.9)';
          setTimeout(() => {
            card.remove();
            // Si ya no quedan tarjetas, recargar para mostrar el empty state
            const remaining = document.querySelectorAll('[id^="juego-card-"]');
            if (remaining.length === 0) {
              window.location.reload();
            }
          }, 400);
        }
      } else {
        showToast(data.message || 'Error al eliminar el juego', 'danger');
      }
    } catch (error) {
      console.error(error);
      showToast('Error de red al intentar eliminar el juego', 'danger');
    }
  }
</script>
@endpush