@foreach (['success'=>'check-circle','error'=>'exclamation-octagon','warning'=>'exclamation-triangle','info'=>'info-circle'] as $type => $icon)
@if(session($type))<div class="alert nv-alert alert-{{ $type }} alert-dismissible fade show" role="alert" aria-live="polite"><i class="bi bi-{{ $icon }} me-2"></i>{{ session($type) }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button></div>@endif
@endforeach
