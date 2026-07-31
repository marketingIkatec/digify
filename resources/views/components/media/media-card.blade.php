@props(['article'])

<article class="namidia-media-card">
    <div>
        <!-- Imagem com link e efeito hover zoom -->
        <div class="namidia-media-card-image-wrap">
            <a href="{{ $article->source_url }}" class="namidia-media-card-image-link" target="_blank">
                <img src="{{ $article->imagem_url }}" 
                     alt="{{ $article->title }}" 
                     loading="lazy"
                     class="namidia-media-card-image">
            </a>
            <!-- Tag de Categoria flutuando ou posicionada acima -->
            <span class="namidia-media-card-category">
                {{ $article->categoria?->categoria }}
            </span>
        </div>

        <!-- Conteúdo do card -->
        <div class="namidia-media-card-body">
            <!-- Data e Marca -->
            <div class="namidia-media-card-meta">
                <span class="namidia-media-card-brand">{{ $article->brand }}</span>
                @if($article->published_at)
                    <time datetime="{{ $article->published_at->toDateString() }}">
                        {{ $article->published_at->format('d/m/Y') }}
                    </time>
                @endif
            </div>

            <!-- Título -->
            <h4 class="namidia-media-card-title">
                <a href="{{ $article->source_url }}" target="_blank">
                    {{ $article->title }}
                </a>
            </h4>

            <!-- Resumo -->
            <p class="namidia-media-card-excerpt">
                {{ $article->excerpt }}
            </p>
        </div>
    </div>

    <!-- Rodapé do Card com Veículo e Link -->
    <div class="namidia-media-card-footer">
        <div class="namidia-media-card-source">
            @if($article->imprensa?->imagem)
                <img src="{{ asset('storage/'.$article->imprensa->imagem) }}" alt="{{ $article->imprensa->imprensa }}" class="namidia-media-card-source-logo">
            @else
                <span class="namidia-media-card-source-name">{{ $article->imprensa?->imprensa }}</span>
            @endif
        </div>

        <a href="{{ $article->source_url }}" 
           class="namidia-media-card-link" target="_blank">
            <span>Ler mais</span>
            <svg class="namidia-icon-xs namidia-link-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </a>
    </div>
</article>
