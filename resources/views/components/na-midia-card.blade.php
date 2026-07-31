<div class="card">
    <a href="{{$item->url}}" target="_blank" rel="noopener noreferrer">
    <img src="{{asset('storage/' . $item->imagem)}}" alt="{{$item->titulo}}">
    <small>{{$item->data_publicacao->format('d/m/Y')}}</small>
    <h3>{{$item->titulo}}</h3>                     
        <div class="card-link">
        Saiba mais
        <span>→</span>
        </div>
    </a>
</div>