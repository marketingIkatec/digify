@extends('app')

@section('content')
@php
    $image = $blog->imagem ? asset('storage/' . $blog->imagem) : '/images/na_midia_hero.png';
@endphp

<div class="blog-page blog-detail-page">
    <article class="blog-article">
        <nav class="blog-breadcrumb">
            <a href="/">Home</a>
            <span>/</span>
            <a href="{{ route('blog.site.index') }}">Blog</a>
            <span>/</span>
            <span>{{ $blog->titulo }}</span>
        </nav>

        <header class="blog-article-header">
            <div class="blog-card-categories blog-article-categories">
                @foreach($blog->categorias as $categoria)
                    <a href="{{ route('blog.categoria.site.show', $categoria->slug) }}">{{ $categoria->categoria }}</a>
                @endforeach
            </div>

            <h1>{{ $blog->titulo }}</h1>

            @if($blog->resumo)
                <p class="blog-article-summary">{{ $blog->resumo }}</p>
            @endif

            <div class="blog-article-meta">
                @if($blog->autor)
                    <a href="{{ route('blog.autor.site.show', $blog->autor->slug) }}" class="blog-article-author">
                        @if($blog->autor->imagem)
                            <img src="{{ asset('storage/' . $blog->autor->imagem) }}" alt="{{ $blog->autor->autor }}">
                        @endif
                        <span>{{ $blog->autor->autor }}</span>
                    </a>
                @endif

                @if($blog->data_blog)
                    <time datetime="{{ $blog->data_blog->toDateString() }}">{{ $blog->data_blog->translatedFormat('d \d\e F \d\e Y') }}</time>
                @endif
            </div>
        </header>

        <div class="blog-article-cover">
            <img src="{{ $image }}" alt="{{ $blog->titulo }}">
        </div>

        <div class="blog-article-layout">
            <div class="blog-article-content">
                {!! $blog->conteudo !!}
            </div>

            <aside class="blog-article-aside">
                @if($blog->autor)
                    <div class="blog-sidebar-card">
                        <h3>Sobre o autor</h3>
                        <div class="blog-author-profile">
                            @if($blog->autor->imagem)
                                <img src="{{ asset('storage/' . $blog->autor->imagem) }}" alt="{{ $blog->autor->autor }}">
                            @endif
                            <strong>{{ $blog->autor->autor }}</strong>
                            @if($blog->autor->resumo)
                                {!! $blog->autor->resumo !!}</p>
                            @endif
                            <a href="{{ route('blog.autor.site.show', $blog->autor->slug) }}">Ver artigos do autor</a>
                        </div>
                    </div>
                @endif

                <div class="blog-sidebar-card">
                    <h3>Compartilhar</h3>
                    <div class="blog-share-links">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->titulo . ' - ' . request()->url()) }}" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                    </div>
                </div>
            </aside>
        </div>
    </article>

    @if(!empty($blogsRelacionados) && $blogsRelacionados->isNotEmpty())
        <section class="blog-related">
            <div class="blog-section-heading">
                <div>
                    <span class="blog-section-kicker">Continue lendo</span>
                    <h2>Artigos relacionados</h2>
                </div>
            </div>

            <div class="blog-grid blog-grid-related">
                @foreach($blogsRelacionados as $related)
                    @php
                        $relatedImage = $related->imagem ? asset('storage/' . $related->imagem) : '/images/na_midia_hero.png';
                    @endphp
                    <article class="blog-card">
                        <a href="{{ route('blog.site.show', $related->slug) }}" class="blog-card-image">
                            <img src="{{ $relatedImage }}" alt="{{ $related->titulo }}" loading="lazy">
                        </a>
                        <div class="blog-card-body">
                            <h3><a href="{{ route('blog.site.show', $related->slug) }}">{{ $related->titulo }}</a></h3>
                            <p>{{ $related->resumo }}</p>
                            <a href="{{ route('blog.site.show', $related->slug) }}" class="blog-read-more">Ler artigo</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
