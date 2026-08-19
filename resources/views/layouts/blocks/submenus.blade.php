@php
    $cssBackgrounds = gerarCssBackgrounds($block->configuracao);
    $cssSection = 'numbered-steps-'.$block->id;
@endphp

@if(!empty($cssBackgrounds))
    <style>
        {!! $cssBackgrounds !!}
    </style>
@endif

<style>

.product-grid{
    background:#f8fafc;
    padding: calc(var(--nav-h) + 56px) 0 var(--space-20);
}

.grid-header{
    text-align:center;
    margin-bottom:70px;
}

.grid-header h1,
.grid-header h2{

  margin-bottom: 1rem;

  
  font-size: var(--font-size-h2);
  font-weight: var(--font-weight-extrabold);
  line-height: 1.12;
  letter-spacing: -.025em;
  color: var(--color-ink);
}

.grid-header p{
    color:#64748b;
}

/* GRID */

.grid-container{
    max-width:1200px;
    margin:auto;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:30px;
}

/* CARD */

.grid-card{
    position:relative;
    background:white;
    border-radius:18px;
    text-decoration:none;
    color:#1e293b;
    overflow:hidden;

    display:flex;
    flex-direction:column;

    transition:all .35s ease;
    box-shadow:0 10px 35px rgba(0,0,0,0.08);
}

.grid-card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 60px rgba(0,0,0,0.15);
}

/* gradiente hover */

.grid-card::before{
    content:"";
    position:absolute;
    inset:0;
    background:linear-gradient(120deg,#6366f1,#06b6d4);
    opacity:0;
    transition:0.4s;
    z-index:0;
}

.grid-card:hover::before{
    opacity:0.08;
}

/* conteúdo acima do gradiente */

.grid-card *{
    position:relative;
    z-index:2;
}

/* ICON */

.icon{
    width:70px;
    height:70px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:34px;
    margin-bottom:20px;
}

/* cores */

.icon-blue{
  background:#e0edff;
  margin-top: 1.7rem;
  margin-left: 2rem;
}

/* textos */

.grid-card h3{    
  text-decoration: none;
  color: #0852c5;
  font-family: Inter;
  line-height: 1.8rem;
  font-size: 1.3rem;
  margin-bottom: 1rem;
}

.grid-card p{
  color: #64748b;
  font-size: 0.9rem;
  margin-bottom: 1rem;
  text-align: left;
}

.grid-card img{
  object-fit: cover;
  height: 9rem;
  width: 100%;
}

.grid-card .text-card{
  padding: 1rem 2rem;
}

/* link */

.card-link{
    font-weight:600;
    color:#2563eb;
    font-size:14px;

    margin-top:auto;
    text-align: left;
    padding: 0rem 2rem 2rem 2rem;
}
</style>
<section class="product-grid">
<div class="container">

    <div class="grid-header">
        {!! renderBlock($block, 'titulo') !!}

        {!! renderBlock($block, 'subtitulo2') !!}

        {!! renderBlock($block, 'conteudo') !!}
    </div>

    <div class="grid-container">
      @foreach($item->children as $subMenu)
      @php
          $url = route('site.show', $subMenu->slug);
          if(strpos($subMenu->slug, 'http') !== false){
            $url = $subMenu->slug;
          }
        @endphp
        @if($subMenu->status)        
          <a href="{{$url}}" class="grid-card">
            @if($subMenu->svg || $subMenu->imagem)
                @if($subMenu->svg)
                <div class="icon icon-blue">
                  {!! $subMenu->svg !!}
                </div>  
                @elseif($subMenu->imagem != '')
                  <div> 
                    <img src="{{asset('storage/' . $subMenu->imagem)}}" alt="{{ $subMenu->titulo }}" title="{{ $subMenu->titulo }}">
                  </div>
                @endif  
              
            @endif
            <div class="text-card">
              <h3>{{$subMenu->titulo}}</h3>
              <p>{{$subMenu->descricao}}</p>
            </div>  

            <span class="card-link">
                Saiba mais →
            </span>
          </a>
        @endif  
      @endforeach
    </div>
  </div>
</section>