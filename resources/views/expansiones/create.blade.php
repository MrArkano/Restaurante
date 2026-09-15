@extends('layouts.app')

@section('title', 'Nueva Expansión')

@section('content')
@php
  $selectedJuegoId = request()->query('juego_id');
  $expansiones = \App\Models\Expansion::with(['juego', 'idioma'])->get();
@endphp

<div class="max-w-4xl mx-auto space-y-8">
  <!-- Volver -->
  <div class="flex items-center justify-between">
    <a href="{{ $selectedJuegoId ? url('/juegos/' . $selectedJuegoId) : url('/juegos') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-400 hover:text-white transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      <span>{{ $selectedJuegoId ? 'Volver al Juego Base' : 'Volver a Juegos' }}</span>
    </a>

    <a href="{{ url('/juegos') }}" class="text-xs text-zinc-400 hover:text-zinc-200">
      Ver Catálogo de Juegos
    </a>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
    <!-- Formulario (3 cols) -->
    <div class="lg:col-span-3">
      <div class="rounded-3xl border border-zinc-800 bg-content1/90 p-8 shadow-2xl relative overflow-hidden backdrop-blur-xl">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-purple-500/10 rounded-full blur-3xl"></div>

        <div class="mb-8">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-semibold mb-3">
            <i data-lucide="puzzle" class="w-3.5 h-3.5"></i>
            <span>Contenido Adicional</span>
          </div>
          <h1 class="text-2xl font-bold tracking-tight text-white">Registrar Expansión</h1>
          <p class="text-xs text-zinc-400 mt-1">Añade una nueva expansión o paquete complementario a un juego existente.</p>
        </div>

        @if(empty($juegos) || count($juegos) === 0)
          <!-- Alerta de falta de juegos -->
          <div class="mb-6 p-4 rounded-2xl bg-amber-950/40 border border-amber-600/40 text-amber-200 text-sm flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5"></i>
            <div class="space-y-2">
              <p class="font-semibold text-amber-300">No hay juegos base registrados</p>
              <p class="text-xs text-amber-200/80">Una expansión debe pertenecer a un juego base. Registra primero al menos un juego.</p>
              <a href="{{ url('/juegos/create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-500/20 hover:bg-amber-500/30 border border-amber-500/40 text-amber-200 text-xs font-semibold transition-all">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>Crear Juego Base</span>
              </a>
            </div>
          </div>
        @endif

        @if(empty($idiomas) || count($idiomas) === 0)
          <!-- Alerta de falta de idiomas -->
          <div class="mb-6 p-4 rounded-2xl bg-amber-950/40 border border-amber-600/40 text-amber-200 text-sm flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5"></i>
            <div class="space-y-2">
              <p class="font-semibold text-amber-300">No hay idiomas disponibles</p>
              <p class="text-xs text-amber-200/80">Debes seleccionar el idioma en el que está editada esta expansión.</p>
              <a href="{{ url('/idiomas/create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-500/20 hover:bg-amber-500/30 border border-amber-500/40 text-amber-200 text-xs font-semibold transition-all">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>Crear Idioma</span>
              </a>
            </div>
          </div>
        @endif

        <form id="create-expansion-form" action="{{ url('/expansiones') }}" method="POST" class="space-y-6">
          @csrf

          <!-- Juego Base -->
          <div class="space-y-2">
            <label for="juego_id" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
              Juego Base Asociado <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                <i data-lucide="gamepad-2" class="w-4 h-4"></i>
              </div>
              <select 
                id="juego_id" 
                name="juego_id" 
                required 
                class="w-full pl-10 pr-10 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all appearance-none cursor-pointer"
              >
                <option value="" disabled {{ empty($selectedJuegoId) ? 'selected' : '' }}>Selecciona el juego principal...</option>
                @foreach($juegos as $juego)
                  <option value="{{ $juego->id }}" {{ (string)$selectedJuegoId === (string)$juego->id ? 'selected' : '' }} class="bg-zinc-900 text-white">
                    {{ $juego->titulo }} ({{ $juego->anio }})
                  </option>
                @endforeach
              </select>
              <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-zinc-500">
                <i data-lucide="chevron-down" class="w-4 h-4"></i>
              </div>
            </div>
          </div>

          <!-- Título de la Expansión -->
          <div class="space-y-2">
            <label for="titulo" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
              Título de la Expansión <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                <i data-lucide="type" class="w-4 h-4"></i>
              </div>
              <input 
                type="text" 
                id="titulo" 
                name="titulo" 
                required 
                maxlength="100"
                placeholder="Ej. Navegantes, Posadas y Catedrales, Ciudades y Caballeros..." 
                class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
              />
            </div>
            <p class="text-[11px] text-zinc-500">Máximo 100 caracteres.</p>
          </div>

          <!-- Año de Publicación -->
          <div class="space-y-2">
            <label for="anio" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
              Año de Publicación <span class="text-zinc-500">(Opcional)</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                <i data-lucide="calendar" class="w-4 h-4"></i>
              </div>
              <input 
                type="number" 
                id="anio" 
                name="anio"
                min="1900"
                max="2099" 
                placeholder="Ej. 2012" 
                class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
              />
            </div>
          </div>

          <!-- Idioma de la Expansión -->
          <div class="space-y-2">
            <label for="idioma_id" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
              Idioma de la Expansión <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                <i data-lucide="globe" class="w-4 h-4"></i>
              </div>
              <select 
                id="idioma_id" 
                name="idioma_id" 
                required 
                class="w-full pl-10 pr-10 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all appearance-none cursor-pointer"
              >
                <option value="" disabled selected>Selecciona el idioma...</option>
                @foreach($idiomas as $idioma)
                  <option value="{{ $idioma->id }}" class="bg-zinc-900 text-white">
                    {{ $idioma->nombre }} ({{ $idioma->codigo }})
                  </option>
                @endforeach
              </select>
              <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-zinc-500">
                <i data-lucide="chevron-down" class="w-4 h-4"></i>
              </div>
            </div>
          </div>

          <!-- Botones -->
          <div class="pt-4 border-t border-zinc-800/80 flex items-center justify-end gap-3">
            <a href="{{ url('/juegos') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold bg-zinc-800 hover:bg-zinc-700 text-zinc-300 transition-all">
              Cancelar
            </a>
            <button 
              type="submit" 
              id="btn-submit-expansion"
              @if(empty($juegos) || count($juegos) === 0 || empty($idiomas) || count($idiomas) === 0) disabled @endif
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-semibold bg-primary hover:bg-primary/90 disabled:opacity-50 disabled:cursor-not-allowed text-white shadow-lg shadow-primary/25 active:scale-95 transition-all"
            >
              <i data-lucide="check" class="w-4 h-4"></i>
              <span>Guardar Expansión</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Lista de Expansiones Existentes (2 cols) -->
    <div class="lg:col-span-2 space-y-4">
      <div class="rounded-3xl border border-zinc-800 bg-content1/80 p-6 flex flex-col justify-between">
        <div>
          <h2 class="text-base font-bold text-white flex items-center justify-between gap-2 mb-1">
            <span>Todas las Expansiones</span>
            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-zinc-800 border border-zinc-700 text-zinc-300">
              {{ count($expansiones) }}
            </span>
          </h2>
          <p class="text-xs text-zinc-400 mb-4">Expansiones registradas en el sistema vinculadas a sus juegos.</p>

          <div class="space-y-2.5 max-h-[460px] overflow-y-auto pr-1">
            @forelse($expansiones as $exp)
              <div id="expansion-list-item-{{ $exp->id }}" class="p-3.5 rounded-xl bg-zinc-900/80 border border-zinc-800 hover:border-zinc-700 transition-all flex items-center justify-between gap-3">
                <div>
                  <h4 class="text-xs font-bold text-white flex items-center gap-2">
                    {{ $exp->titulo }}
                    @if($exp->anio)
                      <span class="text-[10px] font-normal px-1.5 py-0.5 rounded-full bg-zinc-800 text-zinc-400">
                        {{ $exp->anio }}
                      </span>
                    @endif
                  </h4>
                  <div class="flex items-center gap-2 text-[11px] text-zinc-400 mt-1">
                    <span class="text-primary font-medium truncate max-w-[120px]">{{ $exp->juego->titulo ?? 'N/A' }}</span>
                    <span>&bull;</span>
                    <span class="text-zinc-500">{{ $exp->idioma->nombre ?? 'N/A' }}</span>
                  </div>
                </div>

                <button 
                  onclick="eliminarExpansionDirecta({{ $exp->id }}, '{{ addslashes($exp->titulo) }}')" 
                  title="Eliminar expansión"
                  class="p-1.5 rounded-lg text-zinc-500 hover:text-rose-400 hover:bg-rose-950/30 transition-colors"
                >
                  <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                </button>
              </div>
            @empty
              <div class="py-8 text-center text-zinc-500 text-xs">
                <i data-lucide="puzzle" class="w-6 h-6 mx-auto mb-2 opacity-50"></i>
                Aún no hay expansiones registradas.
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const formExp = document.getElementById('create-expansion-form');
  const btnSubmitExp = document.getElementById('btn-submit-expansion');

  formExp.addEventListener('submit', async (e) => {
    e.preventDefault();

    const juego_id = document.getElementById('juego_id').value;
    const titulo = document.getElementById('titulo').value.trim();
    const anio = document.getElementById('anio').value.trim();
    const idioma_id = document.getElementById('idioma_id').value;

    if (!juego_id || !titulo || !idioma_id) {
      showToast('Por favor completa todos los campos requeridos', 'danger');
      return;
    }

    btnSubmitExp.disabled = true;
    const originalText = btnSubmitExp.innerHTML;
    btnSubmitExp.innerHTML = `<span>Guardando...</span>`;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
      const response = await fetch('{{ url("/expansiones") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
          juego_id: parseInt(juego_id),
          titulo: titulo,
          anio: anio ? parseInt(anio) : null,
          idioma_id: parseInt(idioma_id)
        })
      });

      const data = await response.json();

      if (response.ok) {
        showToast(data.message || 'Expansión creada correctamente', 'success');
        setTimeout(() => {
          // Redirigir al detalle del juego asociado para ver la expansión
          window.location.href = `{{ url('/juegos') }}/${juego_id}`;
        }, 700);
      } else {
        showToast(data.message || 'Error al guardar la expansión', 'danger');
        btnSubmitExp.disabled = false;
        btnSubmitExp.innerHTML = originalText;
      }
    } catch (err) {
      console.error(err);
      showToast('Error de conexión al guardar', 'danger');
      btnSubmitExp.disabled = false;
      btnSubmitExp.innerHTML = originalText;
    }
  });

  async function eliminarExpansionDirecta(id, titulo) {
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
        const item = document.getElementById(`expansion-list-item-${id}`);
        if (item) {
          item.remove();
        }
      } else {
        showToast(data.message || 'Error al eliminar', 'danger');
      }
    } catch (e) {
      console.error(e);
      showToast('Error de conexión', 'danger');
    }
  }
</script>
@endpush