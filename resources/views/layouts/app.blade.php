<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Ludoteca') — Colección de Juegos</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            background: '#09090b',
            content1: '#18181b',
            content2: '#27272a',
            content3: '#3f3f46',
            primary: {
              DEFAULT: '#006FEE',
              foreground: '#FFFFFF',
            },
            secondary: {
              DEFAULT: '#7828C8',
              foreground: '#FFFFFF',
            },
            success: {
              DEFAULT: '#17C964',
              foreground: '#000000',
            },
            danger: {
              DEFAULT: '#F31260',
              foreground: '#FFFFFF',
            }
          }
        }
      }
    }
  </script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Fuente Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-background text-zinc-100 min-h-screen flex flex-col justify-between selection:bg-primary/30 selection:text-primary-foreground antialiased overflow-x-hidden">

  <!-- Gradientes de fondo decorativos -->
  <div class="fixed inset-0 pointer-events-none -z-10 flex justify-center">
    <div class="absolute -top-40 w-[600px] h-[400px] bg-primary/15 blur-[140px] rounded-full"></div>
    <div class="absolute top-1/2 -right-40 w-[500px] h-[500px] bg-secondary/15 blur-[160px] rounded-full"></div>
    <div class="absolute bottom-10 -left-40 w-[500px] h-[500px] bg-primary/10 blur-[160px] rounded-full"></div>
  </div>

  <!-- Contenedor de Alertas / Toast -->
  <div id="toast-container" class="fixed top-20 right-6 z-50 flex flex-col gap-3 pointer-events-none"></div>

  <!-- ==================== NAVBAR ==================== -->
  <header class="sticky top-0 z-40 backdrop-blur-md bg-background/75 border-b border-zinc-800/80">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
      
      <!-- Brand / Logo -->
      <a href="{{ url('/juegos') }}" class="flex items-center gap-2.5 font-bold text-xl tracking-tight text-white group">
        <div class="p-2 rounded-xl bg-primary/15 border border-primary/25 text-primary group-hover:scale-105 transition-transform shadow-lg shadow-primary/10">
          <i data-lucide="dices" class="w-5 h-5"></i>
        </div>
        <span>Ludoteca<span class="text-primary">.</span></span>
      </a>

      <!-- Enlaces de navegación -->
      <nav class="hidden md:flex items-center gap-2 text-sm font-medium">
        <a href="{{ url('/juegos') }}" 
           class="px-3.5 py-2 rounded-lg transition-colors flex items-center gap-2 {{ request()->is('juegos') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/50' }}">
          <i data-lucide="gamepad-2" class="w-4 h-4"></i>
          <span>Juegos</span>
        </a>

        <a href="{{ url('/juegos/create') }}" 
           class="px-3.5 py-2 rounded-lg transition-colors flex items-center gap-2 {{ request()->is('juegos/create') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/50' }}">
          <i data-lucide="plus-circle" class="w-4 h-4"></i>
          <span>Nuevo Juego</span>
        </a>

        <a href="{{ url('/expansiones/create') }}" 
           class="px-3.5 py-2 rounded-lg transition-colors flex items-center gap-2 {{ request()->is('expansiones/create') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/50' }}">
          <i data-lucide="puzzle" class="w-4 h-4"></i>
          <span>Nueva Expansión</span>
        </a>

        <a href="{{ url('/idiomas/create') }}" 
           class="px-3.5 py-2 rounded-lg transition-colors flex items-center gap-2 {{ request()->is('idiomas/create') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/50' }}">
          <i data-lucide="globe" class="w-4 h-4"></i>
          <span>Nuevo Idioma</span>
        </a>

        <a href="{{ url('/busqueda') }}" 
           class="px-3.5 py-2 rounded-lg transition-colors flex items-center gap-2 {{ request()->is('busqueda') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/50' }}">
          <i data-lucide="search" class="w-4 h-4"></i>
          <span>Buscar</span>
        </a>
      </nav>

      <!-- Botón de acción rápida -->
      <div class="flex items-center gap-3">
        <a href="{{ url('/juegos/create') }}" class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-semibold bg-primary hover:bg-primary/90 text-white shadow-lg shadow-primary/25 active:scale-95 transition-all">
          <i data-lucide="plus" class="w-3.5 h-3.5"></i>
          <span>Añadir Juego</span>
        </a>

        <!-- Menú Móvil toggle button -->
        <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg bg-zinc-800/50 border border-zinc-700/50 text-zinc-300 hover:text-white">
          <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
      </div>
    </div>

    <!-- Menú Móvil dropdown -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-zinc-800/80 bg-background/95 backdrop-blur-md px-6 py-4 space-y-2">
      <a href="{{ url('/juegos') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->is('juegos') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-300 hover:bg-zinc-800/50' }}">
        <i data-lucide="gamepad-2" class="w-4 h-4"></i>
        <span>Juegos</span>
      </a>
      <a href="{{ url('/juegos/create') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->is('juegos/create') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-300 hover:bg-zinc-800/50' }}">
        <i data-lucide="plus-circle" class="w-4 h-4"></i>
        <span>Nuevo Juego</span>
      </a>
      <a href="{{ url('/expansiones/create') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->is('expansiones/create') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-300 hover:bg-zinc-800/50' }}">
        <i data-lucide="puzzle" class="w-4 h-4"></i>
        <span>Nueva Expansión</span>
      </a>
      <a href="{{ url('/idiomas/create') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->is('idiomas/create') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-300 hover:bg-zinc-800/50' }}">
        <i data-lucide="globe" class="w-4 h-4"></i>
        <span>Nuevo Idioma</span>
      </a>
      <a href="{{ url('/busqueda') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->is('busqueda') ? 'text-primary bg-primary/10 font-semibold' : 'text-zinc-300 hover:bg-zinc-800/50' }}">
        <i data-lucide="search" class="w-4 h-4"></i>
        <span>Buscar</span>
      </a>
    </div>
  </header>

  <!-- ==================== CONTENIDO PRINCIPAL ==================== -->
  <main class="flex-grow max-w-6xl w-full mx-auto px-6 py-8">
    @yield('content')
  </main>

  <!-- ==================== FOOTER ==================== -->
  <footer class="border-t border-zinc-800/60 bg-background/50 backdrop-blur-sm py-8 text-center text-xs text-zinc-500">
    <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-2 text-zinc-400 font-medium">
        <i data-lucide="dices" class="w-4 h-4 text-primary"></i>
        <span>Ludoteca &copy; {{ date('Y') }} — Gestión de Juegos, Idiomas y Expansiones</span>
      </div>
      <div class="flex items-center gap-4 text-zinc-400">
        <a href="{{ url('/juegos') }}" class="hover:text-zinc-200 transition-colors">Juegos</a>
        <a href="{{ url('/idiomas/create') }}" class="hover:text-zinc-200 transition-colors">Idiomas</a>
        <a href="{{ url('/expansiones/create') }}" class="hover:text-zinc-200 transition-colors">Expansiones</a>
      </div>
    </div>
  </footer>

  <!-- Scripts Globales -->
  <script>
    // Inicializar iconos de Lucide
    lucide.createIcons();

    // Toggle de menú móvil
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileBtn && mobileMenu) {
      mobileBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    }

    // Notificaciones Toast flotantes
    window.showToast = function(message, type = 'success') {
      const container = document.getElementById('toast-container');
      if (!container) return;

      const toast = document.createElement('div');
      toast.className = `pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl border shadow-2xl backdrop-blur-md transition-all duration-300 transform translate-y-2 opacity-0 text-sm font-medium ${
        type === 'success' 
          ? 'bg-emerald-950/80 border-emerald-600/40 text-emerald-200 shadow-emerald-900/20' 
          : type === 'danger'
          ? 'bg-rose-950/80 border-rose-600/40 text-rose-200 shadow-rose-900/20'
          : 'bg-zinc-900/90 border-zinc-700 text-zinc-200'
      }`;

      const iconName = type === 'success' ? 'check-circle-2' : (type === 'danger' ? 'alert-triangle' : 'info');
      toast.innerHTML = `
        <i data-lucide="${iconName}" class="w-4 h-4 flex-shrink-0 ${type === 'success' ? 'text-emerald-400' : 'text-rose-400'}"></i>
        <span>${message}</span>
      `;

      container.appendChild(toast);
      lucide.createIcons();

      // Animación de entrada
      requestAnimationFrame(() => {
        toast.classList.remove('translate-y-2', 'opacity-0');
      });

      // Autocierre tras 3.5 segundos
      setTimeout(() => {
        toast.classList.add('opacity-0', 'scale-95');
        setTimeout(() => toast.remove(), 300);
      }, 3500);
    };
  </script>

  @stack('scripts')
</body>
</html>