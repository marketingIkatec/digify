@extends('admin.app')

@section('css_js')
<!-- jQuery + JS do Selectize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- CSS do Selectize -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Colorbox --}}
<link rel="stylesheet" href="/build/assets/app_colorbox.css">
<script src="/build/assets/js_colorbox.js"></script>
@endsection

@section('content')
    <form action="{{ route('admin.site.page.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ old('id', $item->id ?? '') }}" name="id" id="id">    
    
    <x-actions-save-cancel :isStatus="true" :item="$item ?? false" />

    <div class="row mb-5">
        <div class="col-md-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg h-100 toggle-container">                
                <!-- HEADER -->
                <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">

                    <span class="title ps-2 text-white text-lg font-medium">
                        <i class="fa fa-list"></i>
                        Página do Site
                    </span>

                    <span class="toggle-icon js-toggle-icon text-white" title="Expandir / recolher">
                        <i class="fa fa-chevron-down"></i>
                    </span>

                </div>
                
                <div class="toggle-content js-toggle-content {{empty($item) ? 'is-open' : ''}}">        
                    <div class="p-4 sm:p-8">
                        <div class="row mb-3">
                            <div class="col-md-9">
                                <label for="titulo" class="form-label">Título da Página</label>
                                <input type="text" name="titulo" class="form-control onloadUrl equalsMetaTitle @error('titulo') is-invalid @enderror" value="{{ old('titulo', $item->titulo ?? '') }}">
                                @error('titulo') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="locale" class="form-label">Localidade</label>
                                <select id="locale" name="locale" class="form-control @error('locale') is-invalid @enderror">
                                    @if(!empty($webSiteLanguage))
                                        @foreach($webSiteLanguage as $language)
                                            @if(env('APP_LOCALE') == $language->locale)
                                                {{ $language->locale = ''; }}
                                            @endif
                                            <option value="{{ $language->locale }}" data-slug="{{ $language->locale }}" {{ old('locale', $item->locale ?? '') == $language->locale ? 'selected' : '' }}>
                                               {{ $language->label }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('locale') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="page_id" class="form-label">Pagina Pai</label>
                                <select id="page_id" name="page_id" class="form-control @error('page_id') is-invalid @enderror">
                                    <option value="0">Selecione</option>
                                    @if(!empty($paginasPai))
                                        @foreach($paginasPai as $pagina)
                                            <option value="{{ $pagina->id }}" data-slug="{{ $pagina->slug }}" {{ old('page_id', $item->page_id ?? '') == $pagina->id ? 'selected' : '' }}>
                                                {{ $pagina->titulo }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('page_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="header_footer" class="form-label">Mostrar Header e Footer</label>
                                <select id="header_footer" name="header_footer" class="form-control @error('css_app') is-invalid @enderror">
                                    <option value="1" {{ old('header_footer', $item->header_footer ?? '') == '1' ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ old('header_footer', $item->header_footer ?? '') == '0' ? 'selected' : '' }}>Não</option>
                                </select>
                            </div>    
                            
                            <div class="col-md-3">
                                <label for="css_app" class="form-label">CSS Principal</label>
                                <select id="css_app" name="css_app" class="form-control @error('css_app') is-invalid @enderror">
                                    <option value="1" {{ old('css_app', $item->css_app ?? '') == '1' ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ old('css_app', $item->css_app ?? '') == '0' ? 'selected' : '' }}>Não</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="ordem" class="form-label">Ordem</label>
                                <select id="ordem" name="ordem" class="form-control @error('ordem') is-invalid @enderror">
                                    <option value="0">Selecione</option>
                                    @if(!empty($paginasPai))
                                        @for($i = 1; $i <= ($paginasPai->count() + 1); $i++)
                                            <option value="{{ $i }}" {{ old('ordem', $item->ordem ?? '') == $i ? 'selected' : '' }}>
                                                {{ $i }}º
                                            </option>
                                        @endfor
                                    @endif
                                </select>
                            </div>                            
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-2 div-minus-card">
                                <label for="imagem" class="form-label">Selecionar Imagem</label>
                                <input type="file" name="imagem" class="form-control upload-image-card" accept="image/*" id="inputGroupFile">
                                <div class="preview-image mt-2">
                                    <img src="{{ (!empty($item['imagem']) && $item['imagem']) ? asset('storage/'. $item['imagem']) : '' }}" alt="Preview" class="img-thumbnail" style="{{ !empty($item['imagem']) ? 'display: block;' : 'display: none;' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="svg" class="form-label">Svg</label>
                                <div class="input-group mb-3">
                                    @if(!empty($item['svg']))
                                        <span class="input-group-text" id="basic-addon1">{!! $item['svg'] !!}</span>
                                    @endif
                                    <input type="text" name="svg" class="form-control" value="{{ old('svg', $item['svg'] ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea name="descricao" rows="7" class="form-control equalsMetaDescription" rows="2">{{ old('descricao', $item->descricao ?? '') }}</textarea>
                        </div> 
                    </div>                
                </div>                
            </div>           
        </div>

        <div class="col-md-4 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg h-100 toggle-container">                
                <!-- HEADER -->
                <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">
                    <span class="title ps-2 text-white text-lg font-medium">
                        <i class="fa fa-list"></i>
                        SEO da Página
                    </span>
                    <span class="toggle-icon js-toggle-icon text-white" title="Expandir / recolher">
                        <i class="fa fa-chevron-down"></i>
                    </span>
                </div>
                
                
                <div class="toggle-content js-toggle-content {{empty($item) ? 'is-open' : ''}}">
                    <div class="p-4 sm:p-8">                        
                        <div class="col-md-12 mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $item->meta_title ?? '') }}">
                            @error('meta_title') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>                    
                        
                        <div class="col-md-12 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ normalizeMenuUrl(old('slug', $item->slug ?? '')) }}">
                            @error('slug') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control input-selectize @error('meta_keywords') is-invalid @enderror" value="{{ old('meta_keywords', $item->meta_keywords ?? '') }}">
                            @error('meta_keywords') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                    
                        <div class="col-md-12">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $item->meta_description ?? '') }}</textarea>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($item))
    <div class="row mb-5">
        <div class="col-md-12 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg h-100">                
                <div class="bg-gray-800 rounded-top p-1">
                    <span class="title ps-2 text-white text-lg font-medium">
                        <i class="fa fa-laptop" aria-hidden="true"></i> 
                        Conteudo do Página
                    </span>
                </div>
                
                @if(!empty($item->blocks))
                    <div class="p-12 sm:p-8">
                        <div class="page-blocks-grid" id="pageBlocksContainer">
                            @foreach($item->blocks as $block)
                                <x-page-block-card :block="$block" :item="$item"/>
                            @endforeach
                            <div class="page-block-card colorbox" onclick="newBlocoColorbox('{{ $item->id }}');">
                                <i class="fa fa-code"></i> Adicionar Dobra
                                <div class="card-overlay"></div>
                            </div>
                        </div>

                        <input type="hidden" name="order" id="orderInput">
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</form>


<script>
document.addEventListener('change', function (e) {

  const input = e.target.closest('.upload-image-card');
  if (!input) return;

  const file = input.files[0];
  if (!file) return;

  // valida se é imagem
  if (!file.type.startsWith('image/')) {
    alert('Por favor, selecione apenas arquivos de imagem.');
    input.value = '';
    return;
  }

  const previewContainer = input.closest('.div-minus-card')
                                .querySelector('.preview-image img');

  const reader = new FileReader();

  reader.onload = function (event) {
    previewContainer.src = event.target.result;
    previewContainer.style.display = 'block';
  };

  reader.readAsDataURL(file);
});
</script>

<script>

    const paginaSelect = document.querySelector('select[name="page_id"]');
    if(paginaSelect){
        paginaSelect.addEventListener('change', function() {
            if (this.value == {{ env('PAGE_ID_INTEGRACOES') }}) {
                document.querySelector('#integracoesCategoria').style.display = 'block';
            } else {
                document.querySelector('#integracoesCategoria').style.display = 'none';
            }
        });
    }
</script>
@if(!empty($item))
    <script>
        const newBlockUrl = "{{ route('admin.site.page.block', ':itemId') }}";
        function newBlocoColorbox(itemId){
            $.colorbox({
                iframe: true,
                overlayClose: false,
                scrolling: true,
                width: '99%',
                height: '99%',
                href: newBlockUrl.replace(':itemId', itemId),

                onOpen: function () {
                    $('body').addClass('cbox-open');
                },

                onClosed: function () {
                    $('body').removeClass('cbox-open');
                }
            });
        }
    </script>
    @if(!empty($item->blocks))
        <script>
            const editBlockUrlTemplate = "{{ route('admin.site.page.block.edit', ['page' => ':itemId', 'item' => ':blockId']) }}";
            
            function editarBlocoColorbox(itemId, blockId) {
                $.colorbox({
                    iframe: true,
                    overlayClose: false,
                    scrolling: true,
                    width: '99%',
                    height: '99%',
                    href: editBlockUrlTemplate.replace(':itemId', itemId).replace(':blockId', blockId),

                    onOpen: function () {
                        $('body').addClass('cbox-open');
                    },

                    onClosed: function () {
                        $('body').removeClass('cbox-open');
                    }
                });
            }
        </script>
    @endif
 
@endif
@endsection
