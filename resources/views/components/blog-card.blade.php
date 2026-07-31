<div class="blog">
    <div class="blog-card card h-100 shadow-sm border-0">
        <div class="position-relative">
            @php
                $img = asset('storage/'.$config['logo_header']); 
                if(!empty($blogRelacionado->imagem))
                    $img = asset('storage/'.$blogRelacionado->imagem);
            @endphp                        
            <a href="{{route('blog.site.show', $blogRelacionado->slug)}}">
                <img src="{{ $img }}" class="w-100 blog-capa" alt="{{$blogRelacionado->titulo}}" title="{{$blogRelacionado->titulo}}">
            </a>
            @if(!empty($blogRelacionado->autor->imagem))
                <img src="{{ asset('storage/'.$blogRelacionado->autor->imagem) }}" class="author-img" alt="{{$blogRelacionado->autor->autor}}" title="{{$blogRelacionado->autor->autor}}">
            @endif
        </div>
        <div class="card-body bg-white">
            @if(!empty($blogRelacionado->categorias))
                <div class="blog-categorias">                        
                    @foreach($blogRelacionado->categorias as $cat)
                        <div class="categoria-name">
                            <a href="{{ route('blog.categoria.site.show', $cat->slug) }}">
                                {{$cat->categoria}}
                            </a>
                        </div>                            
                    @endforeach
                </div>  
            @endif
            <h5 class="card-title mt-4">
                <a href="{{route('blog.site.show', $blogRelacionado->slug)}}">
                    {{$blogRelacionado->titulo}}
                </a>
            </h5>
            <div class="card-resumo">{{$blogRelacionado->resumo ?? ''}}</div>
            <div class="d-flex align-items-center mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
                <small class="text-muted">{{ ($blogRelacionado->data_blog) ? $blogRelacionado->data_blog->translatedFormat('d \d\e F \d\e Y') : ''}}</small>
            </div>
        </div>
        <a href="{{route('blog.site.show', $blogRelacionado->slug)}}" class="btn btn-thirdy">Ler mais</a>
    </div>
</div> 