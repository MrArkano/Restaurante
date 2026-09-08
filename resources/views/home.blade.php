<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $app_name ?? 'ULibro' }} — Bienvenido al universo literario</title>

  <!-- Tailwind CSS CDN para estilos y tokens de HeroUI -->
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
            primary: {
              DEFAULT: '#006FEE',
              foreground: '#FFFFFF',
            },
            secondary: {
              DEFAULT: '#7828C8',
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

  <!-- ==================== GRADIENT BACKGROUND ACCENTS ==================== -->
  <div class="fixed inset-0 pointer-events-none -z-10 flex justify-center">
    <div class="absolute -top-40 w-[600px] h-[400px] bg-primary/20 blur-[140px] rounded-full"></div>
    <div class="absolute top-1/2 -right-40 w-[500px] h-[500px] bg-secondary/15 blur-[160px] rounded-full"></div>
  </div>

  <!-- ==================== HEROUI NAVBAR ==================== -->
  <header class="sticky top-0 z-50 backdrop-blur-md bg-background/70 border-b border-zinc-800/60">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
      
      <!-- Brand / Logo -->
      <a href="/" class="flex items-center gap-2 font-bold text-xl tracking-tight text-white group">
        <div class="p-2 rounded-xl bg-primary/10 border border-primary/20 text-primary group-hover:scale-105 transition-transform">
          <i data-lucide="book-open" class="w-5 h-5"></i>
        </div>
        <span>{{ $app_name ?? 'ULibro' }}<span class="text-primary">.</span></span>
      </a>

      <!-- Navigation Links -->
      <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-zinc-400">
        <a href="/" class="text-white transition-colors">Inicio</a>
        <a href="/productos" class="hover:text-primary transition-colors flex items-center gap-1.5 font-medium">
          <i data-lucide="shopping-bag" class="w-4 h-4"></i>
          <span>Libros</span>
        </a>
        <a href="/juegos" class="hover:text-primary transition-colors flex items-center gap-1.5 font-medium text-purple-400">
          <i data-lucide="dices" class="w-4 h-4"></i>
          <span>Ludoteca</span>
        </a>
        <a href="#experiencia" class="hover:text-zinc-200 transition-colors">Experiencia</a>
        <a href="#comunidad" class="hover:text-zinc-200 transition-colors">Comunidad</a>
        <a href="#acerca" class="hover:text-zinc-200 transition-colors">Sobre Nosotros</a>
      </nav>

      <!-- Action Button -->
      <div class="flex items-center gap-3">
        <a href="/productos" class="px-4 py-2 rounded-full text-xs font-semibold bg-primary text-primary-foreground hover:bg-primary/90 shadow-lg shadow-primary/20 active:scale-95 transition-all inline-block">
          Ver Catálogo
        </a>
      </div>

    </div>
  </header>

  <!-- ==================== MAIN HERO / WELCOME SECTION ==================== -->
  <main class="flex-1 flex flex-col items-center justify-center text-center px-6 py-16 md:py-24 max-w-4xl mx-auto">
    
    <!-- HeroUI Chip / Badge -->
    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-zinc-900 border border-zinc-800 text-xs font-medium text-zinc-300 shadow-sm mb-6 animate-pulse">
      <span class="flex h-2 w-2 rounded-full bg-primary"></span>
      <span>Tu nuevo punto de encuentro literario</span>
      <i data-lucide="sparkles" class="w-3.5 h-3.5 text-yellow-400"></i>
    </div>

    <!-- Main Heading with Gradient Text -->
    <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white leading-tight mb-6">
      Donde las historias cobran vida y el conocimiento 
      <span class="bg-gradient-to-r from-blue-400 via-primary to-purple-500 bg-clip-text text-transparent">
        encuentra su lugar
      </span>
    </h1>

    <!-- Welcome Subtitle -->
    <p class="text-base sm:text-lg text-zinc-400 max-w-2xl mb-10 leading-relaxed">
      Te damos la bienvenida a <strong class="text-zinc-200">{{ $app_name ?? 'ULibro' }}</strong>. Un espacio diseñado para amantes de la lectura, investigadores y mentes curiosas listas para descubrir su próxima gran aventura.
    </p>

    <!-- Call To Action Buttons -->
    <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto mb-16">
      <!-- Enlace principal a /productos -->
      <a href="/productos" class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-primary text-white font-semibold text-sm shadow-xl shadow-primary/25 hover:shadow-primary/40 hover:-translate-y-0.5 active:scale-95 transition-all flex items-center justify-center gap-2">
        <span>Explorar productos</span>
        <i data-lucide="arrow-right" class="w-4 h-4"></i>
      </a>

      <a href="#experiencia" class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-zinc-900/80 hover:bg-zinc-800 border border-zinc-800 text-zinc-300 font-semibold text-sm active:scale-95 transition-all flex items-center justify-center gap-2">
        <i data-lucide="compass" class="w-4 h-4 text-zinc-400"></i>
        <span>Conoce nuestra propuesta</span>
      </a>
    </div>

    <!-- Feature Highlights -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full text-left" id="experiencia">
      
      <div class="p-5 rounded-2xl bg-content1/60 border border-zinc-800/80 backdrop-blur-sm hover:border-zinc-700 transition-all">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-primary flex items-center justify-center mb-3">
          <i data-lucide="library" class="w-5 h-5"></i>
        </div>
        <h3 class="font-semibold text-white text-sm mb-1">Catálogo Curado</h3>
        <p class="text-xs text-zinc-400 leading-normal">Selección editorial pensada para expandir tu criterio y alimentar tu imaginación.</p>
      </div>

      <div class="p-5 rounded-2xl bg-content1/60 border border-zinc-800/80 backdrop-blur-sm hover:border-zinc-700 transition-all">
        <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center mb-3">
          <i data-lucide="users" class="w-5 h-5"></i>
        </div>
        <h3 class="font-semibold text-white text-sm mb-1">Comunidad Lectora</h3>
        <p class="text-xs text-zinc-400 leading-normal">Encuentros, charlas con autores y clubes de debate para compartir impresiones.</p>
      </div>

      <div class="p-5 rounded-2xl bg-content1/60 border border-zinc-800/80 backdrop-blur-sm hover:border-zinc-700 transition-all">
        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-3">
          <i data-lucide="truck" class="w-5 h-5"></i>
        </div>
        <h3 class="font-semibold text-white text-sm mb-1">Alcance Total</h3>
        <p class="text-xs text-zinc-400 leading-normal">Llegamos a cada rincón para que ningún lector se quede sin su próximo libro.</p>
      </div>

    </div>

  </main>

  <!-- ==================== FOOTER ==================== -->
  <footer class="border-t border-zinc-800/60 py-6 px-6 text-center text-xs text-zinc-500">
    <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
      <p>© 2026 {{ $app_name ?? 'ULibro' }}. Todos los derechos reservados.</p>
      <div class="flex items-center gap-6">
        <a href="#" class="hover:text-zinc-300 transition-colors">Términos</a>
        <a href="#" class="hover:text-zinc-300 transition-colors">Privacidad</a>
        <a href="#" class="hover:text-zinc-300 transition-colors">Contacto</a>
      </div>
    </div>
  </footer>

  <!-- Lucide Icons Initialize -->
  <script>
    lucide.createIcons();
  </script>
</body>
</html>