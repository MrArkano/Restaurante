@extends('layouts.app')

@section('title', $juego->titulo . ' — Detalle del Juego')

@section('content')
@php
  // Expansiones cargadas desde la relación Eloquent (eager loaded en el controlador)
  $expansiones = $juego->expansiones->load('idioma');
@endphp

<div class="max-w-4xl mx-auto space-y-8">
  <!-- Navegación superior -->
  <div class="flex items-center justify-between gap-4">
    <a href="{{ url('/juegos') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-400 hover:text-white transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      <span>Volver a la lista</span>
    </a>

    <div class="flex items-center gap-2">
      <a href="{{ url('/expansiones/create?juego_id=' . $juego->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-purple-600/20 hover:bg-purple-600/30 text-purple-300 border border-purple-500/30 transition-all">
        <i data-lucide="puzzle" class="w-3.5 h-3.5"></i>
        <span>Nueva Expansión</span>
      </a>

      <button onclick="eliminarJuego({{ $juego->id }}, '{{ addslashes($juego->titulo) }}')" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-rose-950/40 hover:bg-rose-900/40 text-rose-300 border border-rose-800/40 transition-all">
        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
        <span>Eliminar</span>
      </button>
    </div>
  </div>

  <!-- Hero Card del Juego -->
  <div class="rounded-3xl border border-zinc-800 bg-content1 p-8 sm:p-10 shadow-2xl relative overflow-hidden">
    <div class="absolute -top-28 -right-28 w-60 h-60 bg-primary/15 rounded-full blur-3xl"></div>

    <div class="flex flex-col sm:flex-row items-start gap-6">
      <!-- Icono grande del juego -->
      <div class="w-20 h-20 rounded-2xl bg-primary/10 border border-primary/20 text-primary flex items-center justify-center flex-shrink-0 shadow-lg shadow-primary/10">
        <i data-lucide="gamepad-2" class="w-10 h-10"></i>
      </div>

      <div class="space-y-4 flex-grow">
        <!-- Badges -->
        <div class="flex flex-wrap items-center gap-2.5">
          <span class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1 rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">
            <i data-lucide="calendar" class="w-3.5 h-3.5 text-zinc-400"></i>
            Año {{ $juego->anio }}
          </span>

          <span class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1 rounded-full bg-primary/10 text-primary border border-primary/25">
            <i data-lucide="globe" class="w-3.5 h-3.5"></i>
            Idioma: {{ $juego->idioma->nombre ?? $juego->idioma ?? 'Sin idioma' }}
          </span>

          <span class="inline-flex items-center gap-1 text-xs font-mono px-2.5 py-1 rounded-full bg-zinc-900 text-zinc-400 border border-zinc-800">
            ID #{{ $juego->id }}
          </span>
        </div>

        <!-- Título -->
        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
          {{ $juego->titulo }}
        </h1>

        <p class="text-sm text-zinc-400 leading-relaxed max-w-2xl">
          Juego base registrado en el catálogo de la ludoteca. Contiene información sobre su año de publicación original y su idioma principal asignado.
        </p>
      </div>
    </div>
  </div>

  <!-- Sección de Expansiones -->
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
          <i data-lucide="puzzle" class="w-5 h-5 text-purple-400"></i>
          Expansiones de este juego
          <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-zinc-800 border border-zinc-700 text-zinc-300">
            {{ count($expansiones) }}
          </span>
        </h2>
        <p class="text-xs text-zinc-400">Módulos, complementos y extensiones para {{ $juego->titulo }}.</p>
      </div>

      <a href="{{ url('/expansiones/create?juego_id=' . $juego->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-primary hover:bg-primary/90 text-white transition-all shadow-md">
        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
        <span>Añadir Expansión</span>
      </a>
    </div>

    @if(count($expansiones) === 0)
      <div class="py-12 px-6 rounded-2xl border border-dashed border-zinc-800 bg-zinc-900/30 text-center">
        <i data-lucide="inbox" class="w-8 h-8 text-zinc-600 mx-auto mb-2"></i>
        <p class="text-sm font-semibold text-zinc-300">Aún no hay expansiones para este juego</p>
        <p class="text-xs text-zinc-500 mt-1 mb-4">¿Tienes alguna expansión o paquete adicional para este título?</p>
        <a href="{{ url('/expansiones/create?juego_id=' . $juego->id) }}" class="inline-flex items-center gap-1 px-4 py-2 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-xs font-semibold transition-all">
          <i data-lucide="plus" class="w-3.5 h-3.5"></i> Registrar Primera Expansión
        </a>
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach($expansiones as $exp)
          <div id="expansion-card-{{ $exp->id }}" class="p-4 rounded-2xl border border-zinc-800 bg-content1 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
              <div class="p-2.5 rounded-xl bg-purple-950/40 text-purple-400 border border-purple-800/40">
                <i data-lucide="puzzle" class="w-4 h-4"></i>
              </div>
              <div>
                <h4 class="text-sm font-bold text-white">{{ $exp->titulo }}</h4>
                <div class="flex items-center gap-2 text-xs text-zinc-400 mt-0.5">
                  <span class="inline-flex items-center gap-1">
                    <i data-lucide="globe" class="w-3 h-3 text-zinc-500"></i>
                    {{ is_object($exp->idioma) ? $exp->idioma->nombre : ($exp->idioma ?? 'N/A') }}
                  </span>
                  <span>&bull;</span>
                  <span class="font-mono text-zinc-500 text-[11px]">ID #{{ $exp->id }}</span>
                </div>
              </div>
            </div>

            <button onclick="eliminarExpansion({{ $exp->id }}, '{{ addslashes($exp->titulo) }}')" title="Eliminar expansión" class="p-2 rounded-lg text-zinc-500 hover:text-rose-400 hover:bg-rose-950/30 border border-transparent hover:border-rose-900/50 transition-colors">
              <i data-lucide="trash-2" class="w-4 h-4"></i>
            </button>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  async function eliminarJuego(id, titulo) {
    if (!confirm(`¿Eliminar definitivamente "${titulo}"?\nSe borrarán todas sus expansiones por eliminación en cascada.`)) {
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
        setTimeout(() => {
          window.location.href = '{{ url("/juegos") }}';
        }, 600);
      } else {
        showToast(data.message || 'Error al eliminar el juego', 'danger');
      }
    } catch (e) {
      console.error(e);
      showToast('Error de red al eliminar el juego', 'danger');
    }
  }

  async function eliminarExpansion(id, titulo) {
    if (!confirm(`¿Eliminar la expansión "${titulo}"?`)) {
      return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
      const response = await fetch(`{{ url('/expansiones') }}/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      });

      const data = await response.json();

      if (response.ok) {
        showToast(data.message || 'Expansión eliminada', 'success');
        const card = document.getElementById(`expansion-card-${id}`);
        if (card) {
          card.style.transition = 'all 0.3s ease';
          card.style.opacity = '0';
          card.style.transform = 'scale(0.95)';
          setTimeout(() => card.remove(), 300);
        }
      } else {
        showToast(data.message || 'Error al eliminar la expansión', 'danger');
      }
    } catch (e) {
      console.error(e);
      showToast('Error de conexión', 'danger');
    }
  }
</script>
@endpush