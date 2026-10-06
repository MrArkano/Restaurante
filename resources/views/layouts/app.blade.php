<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Restaurante</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --color-dark-brown: #1C1412;
            --color-ivory: #FAF6F0;
            --color-gold: #C5A059;
            --color-light-ivory: #FFFBF5;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Lato', sans-serif;
        }

        body {
            background-color: var(--color-ivory);
            font-family: var(--font-sans);
            color: var(--color-dark-brown);
            background-image: radial-gradient(circle at 50% 0%, #ffffff 0%, var(--color-ivory) 80%);
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: var(--font-serif);
        }

        .navbar-custom {
            background-color: var(--color-dark-brown) !important;
            border-bottom: 2px solid var(--color-gold);
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            padding: 1.2rem 0;
        }
        
        .navbar-custom .navbar-brand {
            color: var(--color-ivory) !important;
            font-size: 1.8rem;
            letter-spacing: 1px;
        }

        .navbar-custom .nav-link {
            color: rgba(250, 246, 240, 0.7) !important;
            font-weight: 300;
            letter-spacing: 0.5px;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: var(--color-gold) !important;
        }

        .card-elegant {
            background-color: var(--color-light-ivory);
            border: 1px solid var(--color-gold);
            border-radius: 12px;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(28, 20, 18, 0.05);
        }
        
        .card-elegant:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(197, 160, 89, 0.2);
        }

        .btn-gold {
            border: 1px solid var(--color-gold);
            color: var(--color-dark-brown);
            background-color: transparent;
            font-family: var(--font-sans);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1.5px;
            padding: 0.7rem 1.2rem;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background-color: var(--color-gold);
            color: #fff;
        }

        .text-gold {
            color: var(--color-gold) !important;
        }
        
        .text-dark-brown {
            color: var(--color-dark-brown) !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom mb-5">
        <div class="container">
            <a class="navbar-brand" href="{{ route('platos.index') }}">Admin Restaurante</a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1) sepia(1) saturate(5) hue-rotate(35deg);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link" href="{{ route('platos.index') }}">Platos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu.index') }}">Ver Menú Público</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0" style="background-color: #e6f4ea; color: #1e4620;" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
