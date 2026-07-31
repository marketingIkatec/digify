@props([
    'categories' => collect(),
    'activeBrand' => request('brand'),
    'activeCategory' => request('categoria_id'),
    'search' => request('search')
])

@php
    $filters = collect([['label' => 'Todos', 'type' => 'all', 'value' => 'todos']])
        ->merge($categories->map(fn ($category) => [
            'label' => $category->categoria,
            'type' => 'category',
            'value' => (string) $category->id,
        ]));
@endphp

<div class="namidia-filters">
    <!-- Filtros de Botão -->
    <div class="namidia-filter-list scrollbar-none">
        @foreach($filters as $filter)
            @php
                $isActive = false;
                $url = route('na-midia.index');

                if ($filter['type'] === 'all') {
                    $isActive = !$activeBrand && !$activeCategory;
                } elseif ($filter['type'] === 'brand') {
                    $isActive = strtolower($activeBrand) === strtolower($filter['value']);
                    $url .= '?brand=' . $filter['value'];
                } elseif ($filter['type'] === 'category') {
                    $isActive = (string) $activeCategory === (string) $filter['value'];
                    $url .= '?categoria_id=' . $filter['value'];
                }

                // Preservar a busca se houver
                if ($search && $filter['type'] !== 'all') {
                    $url .= '&search=' . urlencode($search);
                }
            @endphp
            
            <a href="{{ $url }}" class="namidia-filter-chip {{ $isActive ? 'namidia-filter-chip-active' : 'namidia-filter-chip-default' }}">
                {{ $filter['label'] }}
            </a>
        @endforeach
    </div>

    <!-- Campo de Busca -->
    <form action="{{ route('na-midia.index') }}" method="GET" class="namidia-filter-search-form">
        <!-- Manter filtros ativos no submit da busca se desejável -->
        @if($activeBrand)
            <input type="hidden" name="brand" value="{{ $activeBrand }}">
        @endif
        @if($activeCategory)
            <input type="hidden" name="categoria_id" value="{{ $activeCategory }}">
        @endif

        <div class="namidia-filter-search-wrap">
            <input type="text" 
                   name="search" 
                   value="{{ $search }}"
                   placeholder="Pesquisar por assunto, autor ou veículo" 
                   class="namidia-filter-search-input">
            <button type="submit" class="namidia-filter-search-button">
                <svg class="namidia-icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </div>
    </form>
</div>
