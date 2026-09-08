@extends('layouts.app')

@section('title', 'Crear Nuevo Juego')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
  <!-- Volver -->
  <div>
    <a href="{{ url('/juegos') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-400 hover:text-white transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      <span>Volver al catálogo</span>
    </a>
  </div>

  <!-- Tarjeta del Formulario -->
  <div class="rounded-3xl border border-zinc-800 bg-content1/90 p-8 shadow-2xl relative overflow-hidden backdrop-blur-xl">
    <div class="absolute -top-24 -right-24 w-48 h-48 bg-primary/10 rounded-full blur-3xl"></div>

    <div class="mb-8">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary text-xs font-semibold mb-3">
        <i data-lucide="gamepad-2" class="w-3.5 h-3.5"></i>
        <span>Nuevo Registro</span>
      </div>
      <h1 class="text-2xl font-bold tracking-tight text-white">Registrar Juego de Mesa</h1>
      <p class="text-xs text-zinc-400 mt-1">Completa los datos para añadir un nuevo juego al catálogo principal.</p>
    </div>

    @if(empty($idiomas) || count($idiomas) === 0)
      <!-- Aviso de falta de idiomas -->
      <div class="mb-6 p-4 rounded-2xl bg-amber-950/40 border border-amber-600/40 text-amber-200 text-sm flex items-start gap-3">
        <i data-lucide="alert-circle" class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5"></i>
        <div class="space-y-2">
          <p class="font-semibold text-amber-300">No hay idiomas disponibles</p>
          <p class="text-xs text-amber-200/80">Para registrar un juego, primero debes crear al menos un idioma en el sistema.</p>
          <a href="{{ url('/idiomas/create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-500/20 hover:bg-amber-500/30 border border-amber-500/40 text-amber-200 text-xs font-semibold transition-all">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            <span>Crear Idioma Ahora</span>
          </a>
        </div>
      </div>
    @endif

    <form id="create-juego-form" action="{{ url('/juegos') }}" method="POST" class="space-y-6">
      @csrf

      <!-- Título -->
      <div class="space-y-2">
        <label for="titulo" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
          Título del Juego <span class="text-rose-500">*</span>
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
            placeholder="Ej. Catan, Carcassonne, Dixit..." 
            class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
          />
        </div>
        <p class="text-[11px] text-zinc-500">Máximo 100 caracteres.</p>
      </div>

      <!-- Año de publicación -->
      <div class="space-y-2">
        <label for="anio" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
          Año de Publicación <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
            <i data-lucide="calendar" class="w-4 h-4"></i>
          </div>
          <input 
            type="number" 
            id="anio" 
            name="anio" 
            required 
            min="1900" 
            max="2099" 
            value="{{ date('Y') }}"
            placeholder="2024" 
            class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
          />
        </div>
      </div>

      <!-- Idioma -->
      <div class="space-y-2">
        <div class="flex items-center justify-between">
          <label for="idioma_id" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
            Idioma de la Edición <span class="text-rose-500">*</span>
          </label>
          <a href="{{ url('/idiomas/create') }}" class="text-[11px] text-primary hover:underline flex items-center gap-1">
            <i data-lucide="plus" class="w-3 h-3"></i>
            <span>Nuevo idioma</span>
          </a>
        </div>
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
            <option value="" disabled selected>Selecciona un idioma...</option>
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

      <!-- Botones de Acción -->
      <div class="pt-4 border-t border-zinc-800/80 flex items-center justify-end gap-3">
        <a href="{{ url('/juegos') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold bg-zinc-800 hover:bg-zinc-700 text-zinc-300 transition-all">
          Cancelar
        </a>
        <button 
          type="submit" 
          id="btn-submit"
          @if(empty($idiomas) || count($idiomas) === 0) disabled @endif
          class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-semibold bg-primary hover:bg-primary/90 disabled:opacity-50 disabled:cursor-not-allowed text-white shadow-lg shadow-primary/25 active:scale-95 transition-all"
        >
          <i data-lucide="check" class="w-4 h-4"></i>
          <span>Guardar Juego</span>
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const form = document.getElementById('create-juego-form');
  const submitBtn = document.getElementById('btn-submit');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const titulo = document.getElementById('titulo').value.trim();
    const anio = document.getElementById('anio').value;
    const idioma_id = document.getElementById('idioma_id').value;

    if (!titulo || !anio || !idioma_id) {
      showToast('Por favor completa todos los campos obligatorios', 'danger');
      return;
    }

    submitBtn.disabled = true;
    submitBtn.innerHTML = `
      <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      <span>Guardando...</span>
    `;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
      const response = await fetch('{{ url("/juegos") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
          titulo: titulo,
          anio: parseInt(anio),
          idioma_id: parseInt(idioma_id)
        })
      });

      const data = await response.json();

      if (response.ok) {
        showToast(data.message || 'Juego creado correctamente', 'success');
        setTimeout(() => {
          window.location.href = '{{ url("/juegos") }}';
        }, 800);
      } else {
        showToast(data.message || 'Error al guardar el juego', 'danger');
        submitBtn.disabled = false;
        submitBtn.innerHTML = `<i data-lucide="check" class="w-4 h-4"></i><span>Guardar Juego</span>`;
        lucide.createIcons();
      }
    } catch (err) {
      console.error(err);
      showToast('Ocurrió un error inesperado de conexión', 'danger');
      submitBtn.disabled = false;
      submitBtn.innerHTML = `<i data-lucide="check" class="w-4 h-4"></i><span>Guardar Juego</span>`;
      lucide.createIcons();
    }
  });
</script>
@endpush