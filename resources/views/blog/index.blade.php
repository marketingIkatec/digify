@extends('app')

@section('content')
@php
    $search = request('search');
@endphp

<div class="blog-page">
    <section class="blog-hero">
        <div class="blog-hero-content">
            <span class="blog-eyebrow">Digify Blog</span>
            <h1 class="blog-hero-title">Ideias, análise e visão prática para negócios digitais.</h1>
            <p class="blog-hero-text">Leituras objetivas sobre tecnologia, vendas e automação para apoiar decisões mais claras no dia a dia.</p>

            <form action="{{ route('blog.site.index') }}" method="GET" class="blog-search-form">
                <input type="text" name="search" value="{{ $search }}" placeholder="Buscar artigo, categoria ou autor" class="blog-search-input">
                <button type="submit" class="blog-search-button" aria-label="Buscar">
                    <svg class="blog-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>

            <div class="blog-hero-meta">
                <span>{{ $blogs->total() }} artigos publicados</span>
                <span>Atualizado com foco em resultado</span>
            </div>
        </div>
    </section>

    <div class="blog-toolbar">
        <div>
            <span class="blog-section-kicker">Publicações</span>
            <h2>{{ !empty($objSearch) ? $objSearch->display_name : 'Últimos artigos' }}</h2>
        </div>

        <p>{{ $blogs->total() }} conteúdo(s) encontrado(s)</p>
    </div>

    <section class="blog-layout">
        <main class="blog-main">
            @if($blogs->isNotEmpty())
                <div class="blog-grid">
                    @foreach($blogs as $blog)
                        @php
                            $image = $blog->imagem ? asset('storage/' . $blog->imagem) : asset('/images/na_midia_hero.png');
                        @endphp
                        <article class="blog-card">
                            <a href="{{ route('blog.site.show', $blog->slug) }}" class="blog-card-image">
                                <img src="{{ $image }}" alt="{{ $blog->titulo }}" loading="lazy">
                            </a>

                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    @if($blog->autor)
                                        <a href="{{ route('blog.autor.site.show', $blog->autor->slug) }}">{{ $blog->autor->autor }}</a>
                                    @endif
                                    @if($blog->data_blog)
                                        <time datetime="{{ $blog->data_blog->toDateString() }}">{{ $blog->data_blog->format('d/m/Y') }}</time>
                                    @endif
                                </div>

                                <div class="blog-card-categories">
                                    @forelse($blog->categorias as $categoria)
                                        <a href="{{ route('blog.categoria.site.show', $categoria->slug) }}">{{ $categoria->categoria }}</a>
                                    @empty
                                        <span class="blog-chip">Sem categoria</span>
                                    @endforelse
                                </div>

                                <h3><a href="{{ route('blog.site.show', $blog->slug) }}">{{ $blog->titulo }}</a></h3>
                                <p>{{ $blog->resumo }}</p>

                                <a href="{{ route('blog.site.show', $blog->slug) }}" class="blog-read-more">
                                    <span>Ler artigo</span>
                                    <svg class="blog-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if($blogs->hasPages())
                    <div class="blog-pagination">
                        {{ $blogs->links('pagination.namidia') }}
                    </div>
                @endif
            @else
                <div class="blog-empty">
                    <span class="blog-section-kicker">Sem resultados</span>
                    <h3>Nenhum artigo encontrado</h3>
                    <p>Tente remover filtros ou buscar por outro termo.</p>
                    <a href="{{ route('blog.site.index') }}">Ver todos os artigos</a>
                </div>
            @endif
        </main>

        <aside class="blog-sidebar">
            <section class="blog-sidebar-card">
                <span class="blog-section-kicker">Navegação</span>
                <h3>Categorias</h3>
                <div class="blog-sidebar-links">
                    @forelse($blogCategorias as $categoria)
                        <a href="{{ route('blog.categoria.site.show', $categoria->slug) }}">
                            <span>{{ $categoria->categoria }}</span>
                            <span>→</span>
                        </a>
                    @empty
                        <p>Nenhuma categoria ativa.</p>
                    @endforelse
                </div>
            </section>

            <section class="blog-sidebar-card">
                <span class="blog-section-kicker">Autores</span>
                <h3>Equipe que escreve</h3>
                <div class="blog-authors-list">
                    @forelse($blogAutores as $autor)
                        <a href="{{ route('blog.autor.site.show', $autor->slug) }}" class="blog-author-row">
                            @if($autor->imagem)
                                <img src="{{ asset('storage/' . $autor->imagem) }}" alt="{{ $autor->autor }}">
                            @else
                                <span class="blog-author-avatar">{{ mb_substr($autor->autor, 0, 1) }}</span>
                            @endif
                            <span>{{ $autor->autor }}</span>
                        </a>
                    @empty
                        <p>Nenhum autor ativo.</p>
                    @endforelse
                </div>
            </section>
        </aside>
    </section>
</div>
@endsection
