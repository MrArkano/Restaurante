<!DOCTYPE html>
<html lang="es" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Catálogo de Libros — {{ $app_name ?? 'ULibro' }}</title>

  <!-- Tailwind CSS CDN con tokens de HeroUI -->
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

  <!-- Gradientes de fondo decorativos -->
  <div class="fixed inset-0 pointer-events-none -z-10 flex justify-center">
    <div class="absolute -top-40 w-[600px] h-[400px] bg-primary/15 blur-[140px] rounded-full"></div>
    <div class="absolute bottom-10 -left-40 w-[500px] h-[500px] bg-secondary/15 blur-[160px] rounded-full"></div>
  </div>

  <!-- ==================== NAVBAR ==================== -->
  <header class="sticky top-0 z-50 backdrop-blur-md bg-background/70 border-b border-zinc-800/60">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
      
      <!-- Logo -->
      <a href="/" class="flex items-center gap-2 font-bold text-xl tracking-tight text-white group">
        <div class="p-2 rounded-xl bg-primary/10 border border-primary/20 text-primary group-hover:scale-105 transition-transform">
          <i data-lucide="book-open" class="w-5 h-5"></i>
        </div>
        <span>{{ $app_name ?? 'ULibro' }}<span class="text-primary">.</span></span>
      </a>

      <!-- Navegación -->
      <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-zinc-400">
        <a href="/" class="hover:text-zinc-200 transition-colors">Inicio</a>
        <a href="/productos" class="text-primary font-semibold transition-colors flex items-center gap-1.5">
          <i data-lucide="shopping-bag" class="w-4 h-4"></i>
          <span>Libros</span>
        </a>
        <a href="/juegos" class="hover:text-primary transition-colors flex items-center gap-1.5 font-medium text-purple-400">
          <i data-lucide="dices" class="w-4 h-4"></i>
          <span>Ludoteca</span>
        </a>
      </nav>

      <!-- Botón Volver -->
      <div class="flex items-center gap-3">
        <a href="/" class="px-4 py-2 rounded-full text-xs font-semibold bg-zinc-900 hover:bg-zinc-800 border border-zinc-800 text-zinc-300 active:scale-95 transition-all flex items-center gap-1.5">
          <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
          <span>Volver al inicio</span>
        </a>
      </div>

    </div>
  </header>

  <!-- ==================== MAIN CONTENT ==================== -->
  <main class="flex-1 max-w-6xl mx-auto px-6 py-12 w-full">
    
    <!-- Encabezado de la página -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10 pb-6 border-b border-zinc-800/60">
      <div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-xs font-semibold text-primary mb-3">
          <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
          <span>Colección Disponible</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Catálogo de Libros</h1>
        <p class="text-sm text-zinc-400 mt-1">Explora los títulos disponibles y encuentra tu próxima lectura.</p>
      </div>

      <div class="text-xs text-zinc-400 bg-zinc-900/80 border border-zinc-800 px-4 py-2 rounded-xl self-start md:self-auto">
        Mostrando <span class="font-bold text-white">{{ count($productos ?? []) }}</span> libros disponibles
      </div>
    </div>

    <!-- Grid de Productos (HeroUI Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      
      @forelse ($productos ?? [] as $producto)
        <div class="group bg-content1/80 border border-zinc-800 rounded-3xl overflow-hidden hover:border-zinc-700/80 transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between shadow-lg hover:shadow-primary/5">
          
          <div>
            <!-- Imagen con Badges superpuestos -->
            <div class="relative h-56 w-full overflow-hidden bg-zinc-900">
              <img 
                src="{{ $producto['imagen'] }}" 
                alt="{{ $producto['titulo'] }}" 
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                loading="lazy"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-content1 via-transparent to-transparent"></div>
              
              <!-- Badges superiores -->
              <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-background/80 backdrop-blur-md border border-zinc-700/60 text-zinc-200">
                  {{ $producto['categoria'] }}
                </span>
                @if (!empty($producto['destacado']))
                  <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-500/20 backdrop-blur-md border border-amber-500/40 text-amber-300 flex items-center gap-1">
                    <i data-lucide="flame" class="w-3 h-3"></i> Destacado
                  </span>
                @endif
              </div>
            </div>

            <!-- Contenido / Información del libro -->
            <div class="p-5">
              <div class="flex items-center justify-between text-xs text-zinc-400 mb-1.5">
                <span class="flex items-center gap-1">
                  <i data-lucide="user" class="w-3.5 h-3.5 text-zinc-500"></i>
                  {{ $producto['autor'] }}
                </span>
                <span class="text-[11px] {{ $producto['stock'] > 5 ? 'text-emerald-400' : 'text-amber-400' }}">
                  {{ $producto['stock'] }} en stock
                </span>
              </div>

              <h2 class="font-bold text-lg text-white group-hover:text-primary transition-colors line-clamp-1">
                {{ $producto['titulo'] }}
              </h2>

              <p class="text-xs text-zinc-400 mt-2 line-clamp-2 leading-relaxed">
                {{ $producto['descripcion'] }}
              </p>
            </div>
          </div>

          <!-- Footer de la Card: Precio y Botón de compra -->
          <div class="px-5 pb-5 pt-2 border-t border-zinc-800/60 flex items-center justify-between gap-3 mt-auto">
            <div>
              <span class="text-[10px] text-zinc-500 uppercase tracking-wider block font-medium">Precio</span>
              <span class="text-lg font-bold text-white tracking-tight">
                ${{ number_format($producto['precio'], 0, ',', '.') }}
              </span>
            </div>

            <button class="px-4 py-2.5 rounded-xl bg-primary text-white text-xs font-semibold shadow-md shadow-primary/20 hover:bg-primary/90 active:scale-95 transition-all flex items-center gap-2">
              <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
              <span>Comprar</span>
            </button>
          </div>

        </div>
      @empty
        <!-- Estado Vacío si no hay productos -->
        <div class="col-span-full py-16 text-center">
          <div class="w-16 h-16 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center mx-auto mb-4 text-zinc-500">
            <i data-lucide="package-open" class="w-8 h-8"></i>
          </div>
          <h3 class="text-lg font-semibold text-white mb-1">No hay productos registrados</h3>
          <p class="text-xs text-zinc-400">Pronto añadiremos más títulos a la biblioteca.</p>
        </div>
      @endforelse

    </div>

  </main>

  <!-- ==================== FOOTER ==================== -->
  <footer class="border-t border-zinc-800/60 py-6 px-6 text-center text-xs text-zinc-500 mt-12">
    <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
      <p>© 2026 {{ $app_name ?? 'ULibro' }}. Todos los derechos reservados.</p>
      <div class="flex items-center gap-6">
        <a href="/" class="hover:text-zinc-300 transition-colors">Inicio</a>
        <a href="/productos" class="hover:text-zinc-300 transition-colors">Productos</a>
        <a href="#" class="hover:text-zinc-300 transition-colors">Contacto</a>
      </div>
    </div>
  </footer>

  <!-- Inicialización de Lucide Icons -->
  <script>
    lucide.createIcons();
  </script>
</body>
</html>