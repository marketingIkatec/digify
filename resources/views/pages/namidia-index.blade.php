@extends('app')

@section('css_js') 
  <link rel="stylesheet" href="/build/assets/app_blog.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection 

@section('content')
<div class="container">  
  <div class="top-bar">Na mídia Ikatec</div>
  <div id="namidia" class="mb-5">
    

    <div class="container-namidia">
      <div class="row">
        <!-- Botão que abre o menu lateral (somente mobile) -->
        <div class="d-lg-none">
          <button class="btn btn-blue w-100 btn-filtro" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas">
            ☰ Filtros e Pesquisa
          </button>
        </div>

        <div>
          <h5 class="label-search">Qual assunto ou matéria você está procurando?</h5>
          <form action="{{ route('namidia.site.index') }}" method="GET">
            <div class="col-sm-12 my-1 mb-4">
              <div class="input-group">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
                  </div>
                </div>                  
                <input class="form-control" id="search" name="search" value="{{request('search')}}" type="search" placeholder="Faça sua busca aqui" style="border-left: none;">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
              </div>
            </div>
          </form>
         

          @if(!empty($naMidias->count()))
            <div class="col-namidia">
              @foreach($naMidias as $item)                  
                <x-na-midia-card :item="$item ?? false"/>               
              @endforeach                         
            </div>
          @endif
        </div>
        <!-- Sidebar -->
        
      </div>  

      <div class="pagination-namidia justify-content-center">
        {{ $naMidias->onEachSide(0)->links() }}
      </div>

    </div>
  </div>
</div>
@endsection
