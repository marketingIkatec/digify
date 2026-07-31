@props(['expert'])

<div class="namidia-expert-card">
    <!-- Foto do Especialista -->
    <div class="namidia-expert-photo">
        <img src="{{ $expert->imagem ? asset('storage/' . $expert->imagem) : asset('storage/' . getSettings('logo_header')) }}" alt="{{ $expert->autor }}" loading="lazy" class="namidia-cover-image">
    </div>

    <!-- Informações e Link -->
    <div class="namidia-expert-info">
        <h5 class="namidia-expert-name">
            {{ $expert->autor }}
        </h5>
        
        <p class="namidia-expert-role">
            {{ $expert->resumo }}
        </p>
        
        <p class="namidia-expert-count">
            {{ $expert->publications_count }} publicações
        </p>

        <a href="{{ route('na-midia.index', ['search' => $expert->autor]) }}" 
           class="namidia-expert-link">
            <span>Ver artigos</span>
            <svg class="namidia-icon-xs namidia-link-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </a>
    </div>
</div>
