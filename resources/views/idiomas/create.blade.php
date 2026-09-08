@extends('layouts.app')

@section('title', 'Gestión de Idiomas')

@section('content')
@php
  // Obtenemos los idiomas existentes
  $idiomas = \App\Models\Idioma::all();
@endphp

<div class="max-w-4xl mx-auto space-y-8">
  <!-- Volver -->
  <div class="flex items-center justify-between">
    <a href="{{ url('/juegos') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-400 hover:text-white transition-colors">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      <span>Volver a Juegos</span>
    </a>

    <a href="{{ url('/juegos/create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-primary/20 hover:bg-primary/30 text-primary border border-primary/30 transition-all">
      <i data-lucide="gamepad-2" class="w-3.5 h-3.5"></i>
      <span>Ir a Crear Juego</span>
    </a>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
    <!-- Columna Izquierda: Formulario de Creación (3 cols) -->
    <div class="lg:col-span-3">
      <div class="rounded-3xl border border-zinc-800 bg-content1/90 p-8 shadow-2xl relative overflow-hidden backdrop-blur-xl">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-primary/10 rounded-full blur-3xl"></div>

        <div class="mb-6">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary text-xs font-semibold mb-3">
            <i data-lucide="globe" class="w-3.5 h-3.5"></i>
            <span>Configuración de Lenguajes</span>
          </div>
          <h1 class="text-2xl font-bold tracking-tight text-white">Registrar Nuevo Idioma</h1>
          <p class="text-xs text-zinc-400 mt-1">Registra un idioma para clasificar las ediciones de tus juegos y expansiones.</p>
        </div>

        <form id="create-idioma-form" action="{{ url('/idiomas') }}" method="POST" class="space-y-5">
          @csrf

          <!-- Nombre -->
          <div class="space-y-2">
            <label for="nombre" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
              Nombre del Idioma <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                <i data-lucide="type" class="w-4 h-4"></i>
              </div>
              <input 
                type="text" 
                id="nombre" 
                name="nombre" 
                required 
                maxlength="50"
                placeholder="Ej. Español, Inglés, Francés, Alemán..." 
                class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
              />
            </div>
            <p class="text-[11px] text-zinc-500">Nombre completo del idioma (máx. 50 caracteres).</p>
          </div>

          <!-- Código -->
          <div class="space-y-2">
            <label for="codigo" class="block text-xs font-semibold uppercase tracking-wider text-zinc-300">
              Código ISO / Abreviatura <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                <i data-lucide="tag" class="w-4 h-4"></i>
              </div>
              <input 
                type="text" 
                id="codigo" 
                name="codigo" 
                required 
                maxlength="5"
                placeholder="Ej. ES, EN, FR, DE..." 
                class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900/90 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm uppercase focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
              />
            </div>
            <p class="text-[11px] text-zinc-500">Código corto de 2 a 5 letras (ej: ES, EN, DE).</p>
          </div>

          <!-- Botón Enviar -->
          <div class="pt-4 border-t border-zinc-800/80 flex items-center justify-end">
            <button 
              type="submit" 
              id="btn-submit-idioma"
              class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-semibold bg-primary hover:bg-primary/90 text-white shadow-lg shadow-primary/25 active:scale-95 transition-all"
            >
              <i data-lucide="plus" class="w-4 h-4"></i>
              <span>Guardar Idioma</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Columna Derecha: Lista de Idiomas Registrados (2 cols) -->
    <div class="lg:col-span-2 space-y-4">
      <div class="rounded-3xl border border-zinc-800 bg-content1/80 p-6 flex flex-col justify-between">
        <div>
          <h2 class="text-base font-bold text-white flex items-center justify-between gap-2 mb-1">
            <span>Idiomas Registrados</span>
            <span id="idiomas-count" class="text-xs font-semibold px-2 py-0.5 rounded-full bg-zinc-800 border border-zinc-700 text-zinc-300">
              {{ count($idiomas) }}
            </span>
          </h2>
          <p class="text-xs text-zinc-400 mb-4">Idiomas disponibles para asociar a los juegos de mesa.</p>

          <div id="idiomas-list" class="space-y-2.5 max-h-[420px] overflow-y-auto pr-1">
            @forelse($idiomas as $idioma)
              <div id="idioma-item-{{ $idioma->id }}" class="flex items-center justify-between p-3 rounded-xl bg-zinc-900/80 border border-zinc-800 hover:border-zinc-700 transition-all">
                <div class="flex items-center gap-3">
                  <span class="w-8 h-8 rounded-lg bg-primary/10 border border-primary/20 text-primary font-bold text-xs flex items-center justify-center font-mono">
                    {{ strtoupper($idioma->codigo) }}
                  </span>
                  <div>
                    <h4 class="text-xs font-bold text-white">{{ $idioma->nombre }}</h4>
                    <span class="text-[10px] text-zinc-500 font-mono">ID: {{ $idioma->id }}</span>
                  </div>
                </div>

                <button 
                  onclick="eliminarIdioma({{ $idioma->id }}, '{{ addslashes($idioma->nombre) }}')" 
                  title="Eliminar idioma"
                  class="p-1.5 rounded-lg text-zinc-500 hover:text-rose-400 hover:bg-rose-950/30 transition-colors"
                >
                  <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                </button>
              </div>
            @empty
              <div id="no-idiomas-msg" class="py-8 text-center text-zinc-500 text-xs">
                <i data-lucide="globe" class="w-6 h-6 mx-auto mb-2 opacity-50"></i>
                Aún no has registrado ningún idioma.
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
  const formIdioma = document.getElementById('create-idioma-form');
  const btnSubmitIdioma = document.getElementById('btn-submit-idioma');

  formIdioma.addEventListener('submit', async (e) => {
    e.preventDefault();

    const nombre = document.getElementById('nombre').value.trim();
    const codigo = document.getElementById('codigo').value.trim().toUpperCase();

    if (!nombre || !codigo) {
      showToast('Por favor completa todos los campos requeridos', 'danger');
      return;
    }

    btnSubmitIdioma.disabled = true;
    const originalText = btnSubmitIdioma.innerHTML;
    btnSubmitIdioma.innerHTML = `<span>Guardando...</span>`;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
      const response = await fetch('{{ url("/idiomas") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ nombre, codigo })
      });

      const data = await response.json();

      if (response.ok) {
        showToast(data.message || 'Idioma registrado con éxito', 'success');
        // Limpiar inputs
        document.getElementById('nombre').value = '';
        document.getElementById('codigo').value = '';
        // Recargar página tras breve delay para actualizar lista
        setTimeout(() => {
          window.location.reload();
        }, 600);
      } else {
        showToast(data.message || 'Error al registrar idioma', 'danger');
        btnSubmitIdioma.disabled = false;
        btnSubmitIdioma.innerHTML = originalText;
      }
    } catch (err) {
      console.error(err);
      showToast('Error de conexión', 'danger');
      btnSubmitIdioma.disabled = false;
      btnSubmitIdioma.innerHTML = originalText;
    }
  });

  async function eliminarIdioma(id, nombre) {
    if (!confirm(`¿Estás seguro de eliminar el idioma "${nombre}"?\nNota: Si algún juego o expansión depende de él, la base de datos podría restringir la eliminación.`)) {
      return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
      const response = await fetch(`{{ url('/idiomas') }}/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      });

      const data = await response.json();

      if (response.ok) {
        showToast(data.message || 'Idioma eliminado', 'success');
        const item = document.getElementById(`idioma-item-${id}`);
        if (item) {
          item.remove();
        }
      } else {
        showToast(data.message || 'Error al eliminar idioma', 'danger');
      }
    } catch (err) {
      console.error(err);
      showToast('Error de conexión o clave foránea activa', 'danger');
    }
  }
</script>
@endpush