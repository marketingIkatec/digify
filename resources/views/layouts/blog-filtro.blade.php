<div class="categorias">
    @if(!empty($blogCategorias))
      <h5>Categorias</h5>
      <ul class="list-unstyled mt-3">
          @foreach($blogCategorias as $cat)
            <li><a href="{{ route('blog.categoria.site.show', $cat->slug) }}" class="d-block mb-2 {{ request()->routeIs('blog.categoria.site.show') && request()->route('categoria') == $cat->slug ? 'active' : '' }}">{{ $cat->categoria }}</a></li>
          @endforeach
      </ul>
    @endif

    @if(!empty($blogAutores))
      <h5>Autores</h5>
      <ul class="list-unstyled mt-3">
          @foreach($blogAutores as $autor)
            <li><a href="{{ route('blog.autor.site.show', $autor->slug) }}" class="d-block mb-2 {{ request()->routeIs('blog.autor.site.show') && request()->route('autor') == $autor->slug ? 'active' : '' }}">{{ $autor->autor }}</a></li>
          @endforeach
      </ul>
    @endif
</div>