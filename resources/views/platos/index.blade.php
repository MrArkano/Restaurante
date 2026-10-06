@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Listado de Platos</h2>
    <a href="{{ route('platos.create') }}" class="btn btn-primary">
        + Nuevo Plato
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($platos ?? [] as $plato)
                        <tr>
                            <td class="text-center">{{ $plato->id }}</td>
                            <td>
                                @if($plato->imagen)
                                    <img src="{{ asset('storage/' . $plato->imagen) }}" alt="{{ $plato->nombre }}" class="img-thumbnail" style="width: 75px; height: 75px; object-fit: cover;">
                                @else
                                    <span class="text-muted small">Sin imagen</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $plato->nombre }}</td>
                            <td>${{ number_format($plato->precio, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('platos.edit', $plato->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                
                                <form action="{{ route('platos.destroy', $plato->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el plato: {{ $plato->nombre }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No hay platos registrados en el sistema.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(isset($platos) && $platos->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $platos->links() }}
    </div>
@endif
@endsection
