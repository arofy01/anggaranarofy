@props([
    'title',
    'value',
    'icon',
    'color' => 'primary',
    'route'
])

<div class="col-md-4 mb-4">
    <div class="card h-100 shadow-sm hover-card">
        <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center mb-3">
                <div class="icon-container bg-{{ $color }} bg-opacity-10 rounded p-3 me-3">
                    <i class="{{ $icon }} text-{{ $color }} fa-2x"></i>
                </div>
                <div>
                    <h6 class="card-subtitle mb-1 text-muted">{{ $title }}</h6>
                    <h4 class="card-title mb-0 text-{{ $color }}">{{ $value }}</h4>
                </div>
            </div>
            <div class="mt-auto">
                <a href="{{ $route }}" class="btn btn-{{ $color }} w-100 d-flex align-items-center justify-content-center">
                    <span>SELENGKAPNYA</span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
