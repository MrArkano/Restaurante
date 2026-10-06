@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-11 col-lg-10">
        
        <div class="mb-4 text-center text-md-start">
            <a href="{{ route('menu.index') }}" class="btn btn-gold px-4" style="text-transform: none; font-family: var(--font-serif); font-style: italic; font-size: 1.1rem; letter-spacing: 0; font-weight: 400; border: none; border-bottom: 1px solid var(--color-gold); border-radius: 0; padding: 0.2rem 0;">
                &larr; Regresar al Menú
            </a>
        </div>

        <div class="card card-elegant border-0 overflow-hidden mt-4">
            <div class="row g-0">
                <div class="col-md-6 p-2">
                    <div class="overflow-hidden rounded h-100">
                        @if($plato->imagen)
                            <img src="{{ asset('storage/' . $plato->imagen) }}" class="img-fluid w-100 h-100" alt="{{ $plato->nombre }}" style="object-fit: cover; min-height: 500px;">
                        @else
                            <div class="bg-light h-100 d-flex align-items-center justify-content-center text-muted" style="min-height: 500px;">
                                <span>Imagen no disponible</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card-body p-5 d-flex flex-column h-100 justify-content-center">
                        <h2 class="card-title text-dark-brown mb-5" style="font-size: 3rem; line-height: 1.2;">{{ $plato->nombre }}</h2>
                        
                        <div class="mb-5 flex-grow-1">
                            <h5 class="text-gold text-uppercase mb-3" style="font-size: 0.85rem; letter-spacing: 2px;">Descripción de la preparación</h5>
                            <p class="card-text text-dark-brown" style="white-space: pre-line; font-size: 1.15rem; line-height: 1.8; opacity: 0.85;">
                                {{ $plato->descripcion }}
                            </p>
                        </div>
                        
                        <div class="mt-auto">
                            <hr style="border-color: var(--color-gold); opacity: 0.4;" class="mb-4">
                            <div class="d-flex justify-content-between align-items-end">
                                <span class="text-dark-brown text-uppercase pb-2" style="font-size: 0.85rem; letter-spacing: 2px;">Valor</span>
                                <span class="text-gold display-5" style="font-family: var(--font-sans); font-weight: 300;">
                                    ${{ number_format($plato->precio, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
