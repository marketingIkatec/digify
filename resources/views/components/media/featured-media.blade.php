@props(['article'])

@if($article)
<div class="namidia-featured-card">
    <div class="namidia-featured-grid">
        
        <!-- Imagem -->
        <div class="namidia-featured-image-wrap">
            <img src="{{ $article->imagem_url }}" 
                 alt="{{ $article->title }}" 
                 loading="lazy"
                 class="namidia-featured-image-img">
        </div>

        <!-- Conteúdo -->
        <div class="namidia-featured-content">
            <div>
                <div class="namidia-featured-meta">
                    <span class="namidia-featured-pill">
                        Destaque
                    </span>
                    @if($article->published_at)
                        <time class="namidia-featured-date" datetime="{{ $article->published_at->toDateString() }}">
                            {{ $article->published_at->format('d/m/Y') }}
                        </time>
                    @endif
                </div>

                <h3 class="namidia-featured-title">
                    <a href="{{ $article->source_url }}" target="_blank">
                        {{ $article->title }}
                    </a>
                </h3>

                <p class="namidia-featured-excerpt">
                    {{ $article->excerpt }}
                </p>
            </div>

            <div class="namidia-featured-footer">
                <!-- Veículo de Comunicação -->
                <div class="namidia-featured-source">
                    @if($article->imprensa?->imagem)
                        <img src="{{ asset('storage/'.$article->imprensa->imagem) }}" alt="{{ $article->imprensa->imprensa }}" class="namidia-featured-source-logo">
                    @else
                        <span class="namidia-featured-source-name">{{ $article->imprensa?->imprensa }}</span>
                    @endif
                </div>

                <!-- Botão -->
                <a href="{{ $article->source_url }}" 
                   class="namidia-featured-link" target="_blank">
                    <span>Ler matéria completa</span>
                    <svg class="namidia-icon-sm namidia-link-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
