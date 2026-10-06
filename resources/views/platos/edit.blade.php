@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h5 class="mb-0 text-primary">Editar Plato: {{ $plato->nombre }}</h5>
                <a href="{{ route('platos.index') }}" class="btn btn-sm btn-outline-secondary">Volver al listado</a>
            </div>
            <div class="card-body">
                <form action="{{ route('platos.update', $plato->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del plato</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $plato->nombre) }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio ($)</label>
                        <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', $plato->precio) }}" required>
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $plato->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="imagen" class="form-label">Nueva Imagen (Opcional)</label>
                        <div class="d-flex align-items-center mb-2 bg-light p-2 rounded">
                            @if($plato->imagen)
                                <img src="{{ asset('storage/' . $plato->imagen) }}" alt="Miniatura" class="img-thumbnail me-3 shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                            @endif
                            <div class="text-muted small">Sube un archivo nuevo <strong>solo</strong> si deseas reemplazar la imagen actual. Si no subes nada, se mantendrá la misma.</div>
                        </div>
                        <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/jpeg, image/png, image/webp">
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning text-dark fw-bold">Actualizar Plato</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
