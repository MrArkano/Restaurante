@extends('layouts.app')

@section('content')
<div class="mb-5 text-center px-3 mt-4">
    <h1 class="text-dark-brown mb-3" style="font-size: 4rem; letter-spacing: 2px;">Nuestro Menú</h1>
    <p class="text-dark-brown fs-4" style="font-style: italic; font-family: var(--font-serif); opacity: 0.85;">Descubre la exquisita selección de platos que tenemos para ti</p>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5 mb-5 px-lg-4">
    @forelse ($platos as $plato)
        <div class="col">
            <div class="card card-elegant h-100 position-relative p-2 pb-0">
                <div class="overflow-hidden rounded">
                    @if($plato->imagen)
                        <img src="{{ asset('storage/' . $plato->imagen) }}" class="card-img-top" alt="{{ $plato->nombre }}" style="height: 280px; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 280px;">
                            <span>Sin imagen</span>
                        </div>
                    @endif
                </div>
                
                <div class="card-body d-flex flex-column text-center px-4 pb-4 mt-3">
                    <h4 class="card-title text-dark-brown mb-3" style="font-weight: 600; font-size: 1.6rem;">{{ $plato->nombre }}</h4>
                    
                    <div class="mt-auto">
                        <p class="card-text text-gold fs-4 mb-4" style="font-family: var(--font-sans); font-weight: 300;">
                            ${{ number_format($plato->precio, 2) }}
                        </p>
                        <a href="{{ route('menu.show', $plato->id) }}" class="btn btn-gold w-100 stretched-link">
                            Ver Detalle
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 mt-5">
            <div class="alert text-dark-brown fs-5 py-4" style="border: 1px solid var(--color-gold); background: var(--color-light-ivory);" role="alert">
                Lo sentimos, aún no hay platos disponibles en nuestro menú de degustación. ¡Vuelve pronto!
            </div>
        </div>
    @endforelse
</div>
@endsection
