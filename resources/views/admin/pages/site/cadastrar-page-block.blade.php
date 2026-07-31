@php
    include_once public_path('ckeditor/ckeditor.php');

    $CKEditor = new CKEditor();
    $CKEditor->returnOutput = true;

    $CKEditor->basePath = asset('ckeditor/') . '/';
    $CKEditor->config['toolbar'] = array(
        array('Source', 'Undo', 'Redo'),
        array('Bold','Italic','Underline','Strike','-','NumberedList','BulletedList','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Link','Unlink','Anchor','-','Image','Table','HorizontalRule'),
        array('Format','Font','FontSize','-','TextColor','BGColor')
    );
@endphp
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">        
       
        <!-- Favicon / ícones -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Theme / mobile -->
        <meta name="theme-color" content="#0d6efd">

        <!-- Fontes: Red Hat Display & Inter -->
        <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

        <!-- mascara do celular -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
        <!-- mascara do celular -->

        <!-- upload de imagem -->
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css">
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <!-- upload de imagem -->

        <!-- sortablejs -->
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
        <!-- sortablejs -->

        <script src="/build/assets/js_admin.js"></script>
        <script src="/build/assets/js_colorbox.js"></script> 
        <link rel="stylesheet" href="/build/assets/app_admin.css">

        <link rel="stylesheet" href="https://unpkg.com/codemirror@5/lib/codemirror.css">
        <script src="https://unpkg.com/codemirror@5/lib/codemirror.js"></script>
        <script src="https://unpkg.com/codemirror@5/mode/css/css.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="min-h-screen bg-gray-50 flex">
        @include('admin.layouts.header', ['isShowMenu' => false])
        <main class="flex-1 p-6 overflow-auto">       
            <form action="{{ route('admin.site.page.block.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="id" value="{{ $item->id ?? '' }}">
                <input type="hidden" name="page_id" value="{{ $page->id }}">
                <input type="hidden" name="page_slug" value="{{ $page->slug }}">

                <!-- Template (Página) -->
                <div class="row mb-5">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0 text-gray-800 col-md-6">{{(!empty($item) && $item->id) ? 'Editar '.$item->display_name : 'Cadastrar Dobra' }}</h1>
                        
                        <div class="d-flex align-items-center gap-3">
                            <div class="toggle-switch">
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle" {{ old('status', $item->status ?? 1) == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                                <span class="ms-2 align-middle">Status (Inativo/ Ativo)</span>
                                <input type="hidden" name="status" id="status" value="{{ old('status', $item->status ?? 1) }}">
                            </div>            

                            <div>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>                
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif    

                <div class="col-md-12 mb-5">
                
                    <div class="bg-white shadow-sm sm:rounded-lg toggle-container">                
                        <!-- HEADER -->
                        <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">

                            <span class="title ps-2 text-white text-lg font-medium">
                                <i class="fa fa-list"></i>  
                                    Informações da Dobra
                            </span>
                            <span class="toggle-icon js-toggle-icon text-white" title="Expandir / recolher">
                                <i class="fa {{empty($item) ? 'fa-chevron-down' : 'fa-chevron-up' }} "></i>
                            </span>
                        </div>    


                        <div class="toggle-content js-toggle-content {{empty($item) ? 'is-open' : '' }}">
                            <div class="p-4 sm:p-8">
                                <div class="row mb-3">
                                    <div class="row col-md-8">                                    
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tipo do bloco</label>
                                            <select name="tipo_bloco" id="tipo_bloco" class="form-control @error('tipo_bloco') is-invalid @enderror">
                                                <option value="">Selecione</option>
                                                @foreach($pageBlockType as $tipo_bloco)
                                                    @php
                                                    $selected ='';
                                                    if(old('tipo_bloco', $item->tipo_bloco ?? '') == $tipo_bloco['type']){
                                                        $preview =  "<img src='".asset('build/images/placeholder/'.$tipo_bloco['type'].'.png')."' alt='Preview' style='max-width: 100%; height: auto;'>";
                                                        $selected = 'selected';
                                                    }
                                                    @endphp
                                                    <option value="{{ $tipo_bloco['type'] }}" {{$selected}}>{{$tipo_bloco['type']}}</option>
                                                @endforeach
                                            </select>
                                            @error('tipo_bloco') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                        </div>
                                        @php
                                            $displayForm = 'none';
                                            if((old('tipo_bloco', $item->tipo_bloco ?? '') == 'form-custom-hubspot') || (old('tipo_bloco', $item->tipo_bloco ?? '') == 'btn-whatsapp-custom-hubspot') || (old('tipo_bloco', $item->tipo_bloco ?? '') == 'btn-whatsapp-custom-chat-hubspot')){
                                              $displayForm = 'block';  
                                            }  
                                        @endphp
                                        <div id="idFormHubSpot" class="col-md-4 mb-3 formHubSpot" style="display: {{ $displayForm }}">
                                            <label class="form-label">Formulário HubSpot</label>
                                            <select name="form_hubspot_id" id="form_hubspot_id" class="form-control @error('form_hubspot_id') is-invalid @enderror">
                                                <option value="">Selecione</option>
                                                @foreach($formsHubspot as $formHubspot)
                                                    @php
                                                    $selected ='';
                                                    if(old('form_hubspot_id', $formHubSpot_id ?? '') == $formHubspot['id']){
                                                        $selected = 'selected';
                                                    }
                                                    @endphp
                                                    <option value="{{ $formHubspot['id'] }}" {{$selected}}>{{$formHubspot['name']}} - {{$formHubspot['form_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    
                                        <div class="col-md-2" style="width: 13%">
                                            <label for="ordem" class="form-label">Ordem</label>
                                            <select id="ordem" name="ordem" class="form-control @error('ordem') is-invalid @enderror">
                                                <option value="0">Selecione</option>
                                                @if(!empty($page->blocks))
                                                    @for($i = 1; $i <= ($page->blocks->count() + 1); $i++)
                                                        @if(empty($item->ordem) && $i == ($page->blocks->count() + 1))
                                                            @php $selected = 'selected'; @endphp
                                                        @elseif(old('ordem', $item->ordem ?? '') == $i)
                                                            @php $selected = 'selected'; @endphp
                                                        @else
                                                            @php $selected = ''; @endphp
                                                        @endif    

                                                        <option value="{{ $i }}" {{ $selected }}>
                                                            {{ $i }}º
                                                        </option>
                                                    @endfor
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>        

                <div class="row mb-5">
                    <div class="col-md-8 space-y-6">
                        <div class="bg-white shadow-sm sm:rounded-lg">                
                            <div class="bg-gray-800 rounded-top p-1">
                                <span class="title ps-2 text-white text-lg font-medium">
                                    <i class="fa fa-list"></i> 
                                    Conteudo da Dobra
                                </span>
                            </div>                
                            
                            <div class="p-4 sm:p-8">
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="titulo" class="form-label">Título <b class="small">(H1)</b></label>
                                        @php
                                            $CKEditor->config['height'] = 70;
                                            $initialValue = old('titulo', $item->titulo ?? '');
                                            echo $CKEditor->editor('titulo', $initialValue);
                                        @endphp 
                                        @error('titulo') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="subtitulo2" class="form-label">Subtítulo <b class="small">(H2)</b></label>
                                        @php
                                            $initialValue = old('subtitulo2', $item->subtitulo2 ?? '');
                                            echo $CKEditor->editor('subtitulo2', $initialValue);
                                        @endphp 
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="subtitulo3" class="form-label">Subtítulo <b class="small">(H3)</b></label>
                                        @php
                                            $initialValue = old('subtitulo3', $item->subtitulo3 ?? '');
                                            echo $CKEditor->editor('subtitulo3', $initialValue);
                                        @endphp 
                                    </div>

                                    <div class="col-md-12 mb-3 ckeditor-textarea">
                                        <label for="conteudo" class="form-label">Conteúdo <b class="small">(p)</b></label>
                                        @php
                                            $CKEditor->config['height'] = 140;
                                            $initialValue = old('conteudo', $item->conteudo ?? '');
                                            echo $CKEditor->editor('conteudo', $initialValue);
                                        @endphp

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-md-4 space-y-6 form-options-right">

                        <div class="bg-white shadow-sm sm:rounded-lg toggle-container">                
                            <!-- HEADER -->
                            <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">

                                <span class="title ps-2 text-white fs-7">
                                    <i class="fa fa-laptop"></i>  
                                    Background - Cor de Fundo
                                </span>
                                <span class="toggle-icon js-toggle-icon text-white" title="Expandir / recolher">
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </div>
                            <div class="toggle-content js-toggle-content is-open">  
                                <div class="col-md-12 p-4 sm:p-8 bg-select">                                    
                                    <x-input-background-color inputName="configuracao[background]" :item=$item :pageBlockConfig=$pageBlockConfig/>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="bg-white shadow-sm sm:rounded-lg toggle-container">                
                            <!-- HEADER -->
                            <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">

                                <span class="title ps-2 text-white fs-7">
                                    <i class="fa fa-image"></i> 
                                    Upload de Imagem
                                </span>
                                <span class="toggle-icon js-toggle-icon text-white" title="Expandir / recolher">
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </div>
                            
                            <div class="toggle-content js-toggle-content {{!empty($item->configuracao['image']['file']) || !empty($item->configuracao['image']['url']) ? 'is-open' : ''}}">  
                                <div class="content-tabs p-2">
                                    <div class="tabs" id="tab-imagem">
                                        <div class="tabs-header">
                                            <a class="tab-btn active" href="javascript:void(0)" data-tab="tab-imagem-1">Imagem</a>
                                            <a class="tab-btn" href="javascript:void(0)" data-tab="tab-imagem-2">Propriedades</a>
                                        </div>
                                        <div class="tabs-body">
                                            <div class="tab-content active" id="tab-imagem-1">
                                                @php
                                                    $image = $item->configuracao['image'] ?? [];

                                                    $dataImage = !empty($image['file'])
                                                        ? asset('storage/'.$image['file'])
                                                        : ($image['url'] ?? '');
                                                @endphp  
                                                <div id="imageDropzone" class="upload-dropzone dropzone" data-image="{{$dataImage}}">
                                                    <div class="dz-message">
                                                        <strong>Upload your image</strong><br>
                                                        <span>Click or drop image here</span>
                                                    </div>
                                                    <input type="hidden" name="remove_image" id="removeImage" value="0">
                                                    <input type="hidden" name="image_path" value="{{ $item->configuracao['image']['file']?? ''}}" id="imagePath">
                                                </div>
                                                <div class="col-md-12 mt-2 mb-2">
                                                    <label for="configuracao[image][url]" class="form-label">URL Imagem</label>
                                                    <input type="text" name="configuracao[image][url]" class="form-control" value="{{ old('configuracao[image][url]', $item->configuracao['image']['url'] ?? '') }}">
                                                </div> 
                                                <div class="col-md-12 mb-2">
                                                    @php
                                                        $savedValue = old('configuracao[image][justify-content]', ($item->configuracao['image']['justify-content']) ?? '');
                                                    @endphp
                                                    <label for="configuracao[image][justify-content]" class="form-label">Alinhar Imagem</label>
                                                    <select name="configuracao[image][justify-content]" class="form-control">
                                                        <option value="">selecione</option>
                                                        <option value="end" {{ (($savedValue == 'end') ? 'selected' : '') }}>A Direita</option>
                                                        <option value="start" {{ (($savedValue == 'start') ? 'selected' : '') }}>A Esquerda</option>

                                                        <option value="flex-end" {{ (($savedValue == 'flex-end') ? 'selected' : '') }}>A Direita da tela</option>
                                                        <option value="flex-start" {{ (($savedValue == 'flex-start') ? 'selected' : '') }}>A Esquerda da tela</option>
                                                        {{--<option value="bottom-right" {{ (($savedValue == 'bottom-right') ? 'selected' : '') }}>Embaixo e a Direita da tela</option>
                                                        <option value="bottom-left" {{ (($savedValue == 'bottom-left') ? 'selected' : '') }}>Embaixo e a Esquerda da tela</option>
                                                        {{--<option value="center" {{ (($savedValue == 'center') ? 'selected' : '') }}>Centralizado</option>                                                        
                                                        <option value="space-around" {{ (($savedValue == 'space-around') ? 'selected' : '') }}>space-around</option>                                                        
                                                        <option value="space-between" {{ (($savedValue == 'space-between') ? 'selected' : '') }}>space-between</option>                                                        
                                                        <option value="space-evenly" {{ (($savedValue == 'space-evenly') ? 'selected' : '') }}>space-evenly</option>                                                        
                                                        --}}
                                                    </select>
                                                </div>   
                                            </div>
                                            <div class="tab-content" id="tab-imagem-2"> 
                                                <div class="row mt-3 mb-3">  
                                                    <div class="col-md-6 mb-2">
                                                        <label for="configuracao[image][alt]" class="form-label">Alt</label>
                                                        <input type="text" name="configuracao[image][alt]" class="form-control" value="{{ old('configuracao[image][alt]', $item->configuracao['image']['alt'] ?? '') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="configuracao[image][title]" class="form-label">Title</label>
                                                        <input type="text" name="configuracao[image][title]" class="form-control" value="{{ old('configuracao[image][title]', $item->configuracao['image']['title'] ?? '') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="configuracao[image][class]" class="form-label">Class</label>
                                                        <input type="text" name="configuracao[image][class]" class="form-control" value="{{ old('configuracao[image][class]', $item->configuracao['image']['class'] ?? '') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="configuracao[image][style]" class="form-label">Style</label>
                                                        <input type="text" name="configuracao[image][style]" class="form-control" value="{{ old('configuracao[image][style]', $item->configuracao['image']['style'] ?? '') }}">
                                                    </div>
                                                </div>                         
                                            </div>                         
                                        </div>                         
                                    </div>                         
                                </div> 
                            </div>
                        </div>
                        
                        {{-- 
                        <div class="bg-white shadow-sm sm:rounded-lg toggle-container">                
                            <!-- HEADER -->
                            <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">

                                <span class="title ps-2 text-white fs-7">
                                    <i class="fa fa-globe"></i>  
                                    Botão
                                </span>
                                <span class="toggle-icon js-toggle-icon text-white" title="Expandir / recolher">
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </div>
                            <div class="toggle-content js-toggle-content {{!empty($item->configuracao['button_text']) ? 'is-open' : ''}}">  
                                <div class="p-4">
                                    <div class="col-md-12 mb-2">
                                        <label for="meta_title" class="form-label">Texto do botão</label>
                                        <input type="text" name="configuracao[button_text]" class="form-control" value="{{ old('configuracao[button_text]', $item->configuracao['button_text'] ?? '') }}">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="meta_title" class="form-label">Link do botão</label>
                                        <input type="text" name="configuracao[button_link]" class="form-control" value="{{ old('configuracao[button_link]', $item->configuracao['button_link'] ?? '') }}">
                                    </div>
                                    
                                    <x-input-background-color inputName="configuracao[button_background]" :item=$item :pageBlockConfig=$pageBlockConfig/> 
                                </div>                            
                            </div>                            
                        </div>
                        --}}

                        @php
                            $buttons = ['primary' => 'Primário', 'secondary' => 'Secundário'];
                        @endphp
                        @foreach($buttons as $key => $title)
                            @php
                                $button_name = 'button-'.$key;
                            @endphp
                            <div class="bg-white shadow-sm sm:rounded-lg toggle-container">                
                                <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">
                                    <span class="title ps-2 text-white fs-7">
                                        <i class="fa fa-globe"></i> 
                                        Botão {{$title}}
                                    </span>
                                    <span class="toggle-icon js-toggle-icon text-white is-open" title="Expandir / recolher">
                                        <i class="fa fa-chevron-down"></i>
                                    </span>
                                </div>
                                <div class="toggle-content js-toggle-content {{!empty($item->configuracao[$button_name]['text']) ? 'is-open' : ''}}">
                                    <div class="p-4 sm:p-8">                                        
                                        <div class="row mb-3">                                        
                                            <div class="col-md-12 mb-2">
                                                <label class="form-label">Texto do botão</label>                                            
                                                <input type="text" name="configuracao[{{$button_name}}][text]" placeholder="Texto" class="form-control" value="{{ old('configuracao[$button_name][text]', $item->configuracao[$button_name]['text'] ?? '') }}">
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label class="form-label">Link do botão</label>                                            
                                                <input type="text" name="configuracao[{{$button_name}}][link]" placeholder="Link" class="form-control" value="{{ old('configuracao[$button_name][link]', $item->configuracao[$button_name]['link'] ?? '') }}">
                                            </div>
                                            <div class="button-config">
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label">Modelo para Background Color e Cor do Texto</label>    
                                                    <select name="configuracao[{{$button_name}}][btn_css]" class="form-control js-button-select">
                                                        @php
                                                            $savedValue = old('configuracao[$button_name][btn_css]', ($item->configuracao[$button_name]['btn_css']) ?? '');
                                                        @endphp
                                                        <option value="">Selecione um modelo</option>
                                                        @if(!empty($pageBlockConfigButton))
                                                            @foreach($pageBlockConfigButton as $configItem)
                                                                <option value="{{ $configItem->configuracao }}"
                                                                    @selected($savedValue === $configItem->configuracao)>
                                                                    {{ $configItem->nome }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label">Background Color</label>                                            
                                                        <input type="color" name="configuracao[{{$button_name}}][background]" placeholder="Cor do Botão" class="form-control form-control-color js-button-background-input" value="{{ old('configuracao[$button_name][background]', $item->configuracao[$button_name]['background'] ?? '') }}" style="height: 25px;">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label">Cor do Texto </label>                                            
                                                        <input type="color" name="configuracao[{{$button_name}}][color]" placeholder="Cor do Texto" class="form-control form-control-color js-button-color-input" value="{{ old('configuracao[$button_name][color]', $item->configuracao[$button_name]['color'] ?? '') }}" style="height: 25px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach  
                        
                        <div class="bg-white shadow-sm sm:rounded-lg toggle-container">                
                            <!-- HEADER -->
                            <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">

                                <span class="title ps-2 text-white fs-7">
                                    <i class="fa fa-play"></i> 
                                    Video Youtube
                                </span>
                                <span class="toggle-icon js-toggle-icon text-white" title="Expandir / recolher">
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </div>
                            
                            <div class="toggle-content js-toggle-content {{!empty($item->configuracao['video']['url']) ? 'is-open' : ''}}">  
                                <div class="p-4">
                                    <div class="col-md-12 mb-2">
                                        <label for="configuracao[video][url]" class="form-label">Url</label>
                                        <input type="text" name="configuracao[video][url]" class="form-control" value="{{ old('configuracao[video][url]', $item->configuracao['video']['url'] ?? '') }}">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="configuracao[video][title]" class="form-label">Título</label>
                                        <input type="text" name="configuracao[video][title]" class="form-control" value="{{ old('configuracao[video][title]', $item->configuracao['video']['title'] ?? '') }}">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="configuracao[video][descricao]" class="form-label">Descrição</label>
                                        <textarea name="configuracao[video][descricao]" rows="4" class="form-control">{{ old('configuracao[video][descricao]', $item->configuracao['video']['descricao'] ?? '') }}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-2 preview-video">
                                        @php
                                            $youtubeId = !empty($item->configuracao['video']['url']) ? getYoutubeId($item->configuracao['video']['url']) : null;
                                        @endphp
                                        @if ($youtubeId)
                                            <iframe 
                                                width="100%" 
                                                height="155" 
                                                src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                                title="{{ $item->configuracao['video']['title'] }}" 
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        @endif
                                    </div>                                                           
                                </div>
                            </div>
                        </div>

                        <div class="bg-white shadow-sm sm:rounded-lg toggle-container">                
                            <!-- HEADER -->
                            <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">

                                <span class="title ps-2 text-white fs-7">
                                    <i class="fa fa-play"></i> 
                                    Cards
                                </span>
                                <span class="toggle-icon js-toggle-icon text-white" title="Expandir / recolher">
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </div>
                            
                            <div class="toggle-content js-toggle-content {{!empty($item->configuracao['cards']) ? 'is-open' : ''}}" style="max-height: unset; overflow-y: auto;">  
                                
                                <div class="content-tabs p-2">                                                          
                                    <div class="tabs" id="tab-cards">
                                        <div class="tabs-header">
                                            <a class="tab-btn active" href="javascript:void(0)" data-tab="tab-cards-1">Background</a>
                                            {{--<a class="tab-btn" href="javascript:void(0)" data-tab="tab-cards-3">Aba</a>--}}
                                            <a class="tab-btn" href="javascript:void(0)" data-tab="tab-cards-2">Card</a>                                       
                                        </div>

                                        <div class="tabs-body">
                                            <div class="tab-content active" id="tab-cards-1">      
                                                <div class="col-md-12 p-4 sm:p-8 bg-select">
                                                    <label class="form-label">Cor de Fundo do Card</label>                               
                                                    <x-input-background-color inputName="configuracao[cards_background]" :item=$item :pageBlockConfig=$pageBlockConfig/>
                                                </div>
                                                <div class="col-md-12 mb-2 color-toggle">
                                                    <div class="form-check">
                                                        <input
                                                            type="checkbox"
                                                            class="form-check-input js-toggle-color"
                                                            name="configuracao[is_cards_color_text]"
                                                            value="true"
                                                            {{ old(
                                                                'configuracao[is_cards_color_text]',
                                                                $item->configuracao['is_cards_color_text'] ?? false
                                                            ) ? 'checked' : '' }}
                                                        >
                                                        <label class="form-label">
                                                            Habilitar Cor do Texto
                                                        </label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5 mb-2">
                                                            <label class="form-label">Cor do Título <b class="small">(h3)</b></label>    
                                                            <input
                                                                type="color"
                                                                name="configuracao[cards_color_text]"
                                                                class="form-control form-control-color js-color-input"
                                                                value="{{ old('configuracao[cards_color_text]', $item->configuracao['cards_color_text'] ?? '') }}"
                                                                style="height: 25px;"
                                                            >
                                                        </div>
                                                        <div class="col-md-5 mb-2">
                                                            <label class="form-label">Descrição <b class="small">(p)</b></label>    
                                                            <input
                                                                type="color"
                                                                name="configuracao[cards_color_text_descricao]"
                                                                class="form-control form-control-color js-color-input"
                                                                value="{{ old('configuracao[cards_color_text_descricao]', $item->configuracao['cards_color_text_descricao'] ?? '') }}"
                                                                style="height: 25px;"
                                                            >
                                                        </div>
                                                        <div class="col-md-5 mb-2">
                                                            <label class="form-label">Cor Fundo do Icone</label>    
                                                            <input
                                                                type="color"
                                                                name="configuracao[cards_color_icone]"
                                                                class="form-control form-control-color js-color-input"
                                                                value="{{ old('configuracao[cards_color_icone]', $item->configuracao['cards_color_icone'] ?? '') }}"
                                                                style="height: 25px;"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5 mb-2">
                                                        <label class="form-label">Nº de cards por linha</label>    
                                                        <input
                                                            type="number"
                                                            name="configuracao[cards_qtde_linha]"
                                                            class="form-control"
                                                            value="{{ old('configuracao[cards_qtde_linha]', $item->configuracao['cards_qtde_linha'] ?? '') }}"
                                                            style="height: 25px;"
                                                        >
                                                    </div>
                                                    <div class="col-md-5 mb-2">
                                                        @php
                                                            $savedValue = old('configuracao[cards_text_align]', ($item->configuracao['cards_text_align']) ?? '');
                                                        @endphp
                                                        <label class="form-label">Alinhamento do Texto</label>    
                                                        <select name="configuracao[cards_text_align]" class="form-control">
                                                            <option value="left" {{ (($savedValue == 'left') ? 'selected' : '') }}>Left</option>
                                                            <option value="right" {{ (($savedValue == 'right') ? 'selected' : '') }}>Right</option>
                                                            <option value="center" {{ (($savedValue == 'center') ? 'selected' : '') }}>Center</option>
                                                        </select> 
                                                    </div>    
                                                </div>    
                                            </div>

                                            <div class="tab-content" id="tab-cards-2"> 
                                                <!--<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
                                                    <a class="btn btn-secondary btn-sm btn-add-card"><i class="fa fa-add"></i> Card</a> 
                                                </div>-->
                                                <div id="cards-container">    
                                                    @if(!empty($item->configuracao['cards']))
                                                        @foreach($item->configuracao['cards'] as $key => $card)
                                                            <div class="card-sortable p-4">
                                                                <div class="col-md-12 mb-2">                                                                
                                                                    <label for="configuracao[cards][{{ $key }}][title]" class="form-label">Título <b class="small">(h3)</b></label>
                                                                    <i class="fa fa-trash cursor-pointer float-end btn-remove-card me-2" title="Remover Card"></i>
                                                                    <i class="fa fa-arrows-alt cursor-move btn-move-card float-end me-2" title="Arrastar para reordenar"></i>
                                                                    <i class="fa fa-minus-square cursor-pointer float-end btn-minus-card me-2" title="Minimizar Card"></i>
                                                                    <input type="text" name="configuracao[cards][{{ $key }}][title]" class="form-control" value="{{ old('configuracao[cards][$key][title]', $card['title'] ?? '') }}">
                                                                </div>

                                                                <div class="tabs" id="tab-{{ $key }}-card">
                                                                    <div class="tabs-header">
                                                                        <a class="tab-btn active" data-tab="tab-{{ $key }}-card">Card</a>
                                                                        <a class="tab-btn" data-tab="tab-{{ $key }}-button">Botão</a>
                                                                        <a class="tab-btn" data-tab="tab-{{ $key }}-image">Imagem</a>
                                                                    </div>

                                                                    <div class="tabs-body">
                                                                        <div class="tab-content active" id="tab-{{ $key }}-card">
                                                                            <div class="col-md-12 mb-2 div-minus-card">
                                                                                <label for="configuracao[cards][{{ $key }}][subtitulo2]" class="form-label">Subtítulo <b class="small">(h4)</b></label>
                                                                                <input type="text" name="configuracao[cards][{{ $key }}][subtitulo2]" class="form-control" value="{{ old('configuracao[cards][$key][subtitulo2]', $card['subtitulo2'] ?? '') }}">
                                                                            </div>
                                                                            <div class="col-md-12 mb-2 div-minus-card">
                                                                                <label for="configuracao[cards][{{ $key }}][subtitulo3]" class="form-label">Subtítulo <b class="small">(h5)</b></label>
                                                                                <input type="text" name="configuracao[cards][{{ $key }}][subtitulo3]" class="form-control" value="{{ old('configuracao[cards][$key][subtitulo3]', $card['subtitulo3'] ?? '') }}">
                                                                            </div>
                                                                            <div class="col-md-12 mb-2 div-minus-card">
                                                                                <label for="configuracao[cards][{{ $key }}][descricao]" class="form-label">Descrição <b class="small">(p)</b></label>
                                                                                <textarea name="configuracao[cards][{{ $key }}][descricao]" rows="4" class="form-control">{{ old('configuracao[cards][$key][descricao]', $card['descricao'] ?? '') }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-content" id="tab-{{ $key }}-button">
                                                                            <div class="col-md-12 mb-2 div-minus-card">                                        
                                                                                <div class="row mb-3">                                        
                                                                                    <div class="col-md-12 mb-2">
                                                                                        <label class="form-label">Texto do botão</label>                                            
                                                                                        <input type="text" name="configuracao[cards][{{ $key }}][button][text]" placeholder="Texto" class="form-control" value="{{ old('configuracao[cards][$key][button][text]', $card['button']['text'] ?? '') }}">
                                                                                    </div>
                                                                                    <div class="col-md-12 mb-2">
                                                                                        <label class="form-label">Link do botão</label>                                            
                                                                                        <input type="text" name="configuracao[cards][{{ $key }}][button][link]" placeholder="Link" class="form-control" value="{{ old('configuracao[cards][$key][button][link]', $card['button']['link'] ?? '') }}">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-2">
                                                                                        <label class="form-label">Background Color</label>                                            
                                                                                        <input type="color" name="configuracao[cards][{{ $key }}][button][background]" placeholder="Cor do Botão" class="form-control form-control-color" value="{{ old('configuracao[cards][$key][button][background]', $card['button']['background'] ?? '') }}" style="height: 25px;">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-2">
                                                                                        <label class="form-label">Cor do Texto </label>                                            
                                                                                        <input type="color" name="configuracao[cards][{{ $key }}][button][color]" placeholder="Cor do Texto" class="form-control form-control-color" value="{{ old('configuracao[cards][$key][button][color]', $card['button']['color'] ?? '') }}" style="height: 25px;">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-content" id="tab-{{ $key }}-image">
                                                                            <div class="col-md-12 mb-2 div-minus-card">
                                                                                <label for="configuracao[cards][{{ $key }}][image]" class="form-label">Selecionar Imagem</label>
                                                                                <input type="file" name="configuracao[cards][{{ $key }}][image]" class="form-control upload-image-card" accept="image/*" id="inputGroupFile{{ $key }}">
                                                                                <div class="preview-image mt-2">
                                                                                    <input type="hidden" name="configuracao[cards][{{ $key }}][imageSaved]" value="{{ $card['image'] ?? '' }}">
                                                                                    <img src="{{ (!empty($card['image']) && $card['image']) ? asset('storage/'. $card['image']) : '' }}" alt="Preview" class="img-thumbnail" style="{{ !empty($card['image']) ? 'display: block;' : 'display: none;' }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 mb-2 div-minus-card">
                                                                                <label for="configuracao[cards][{{ $key }}][icone]" class="form-label">Svg</label>
                                                                                <div class="input-group mb-3">
                                                                                    @if($card['icone'])
                                                                                        <span class="input-group-text" id="basic-addon1" style="{{(!empty($item) && !empty($item->configuracao['cards-background-color-'.$item->id])) ? $item->configuracao['cards-background-color-'.$item->id] : ''}}">{!! $card['icone'] !!}</span>
                                                                                    @endif
                                                                                    <input type="text" name="configuracao[cards][{{ $key }}][icone]" class="form-control" value="{{ old('configuracao[cards][$key][icone]', $card['icone'] ?? '') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <input type="hidden" id="cardCount" value="{{ !empty($item->configuracao['cards']) ? count($item->configuracao['cards']) : 0 }}">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
                                                    <a class="btn btn-secondary btn-sm btn-add-card"><i class="fa fa-add"></i> Card</a> 
                                                </div>
                                            </div>

                                            {{--<div class="tab-content" id="tab-cards-3">
                                                
                                                

                                            </div>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                        
                        
                        <div class="bg-white shadow-sm sm:rounded-lg toggle-container">                
                            <!-- HEADER -->
                            <div class="bg-gray-800 rounded-top p-2 d-flex align-items-center justify-content-between">

                                <span class="title ps-2 text-white fs-7">
                                    <i class="fa fa-play"></i> 
                                    CSS Editor
                                </span>
                                <span class="toggle-icon js-toggle-icon text-white" title="Expandir / recolher">
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </div>
                            
                            <div class="toggle-content js-toggle-content {{!empty($item->configuracao['css_editor']) ? 'is-open' : ''}}">  
                                <div class="p-4">
                                    <div class="col-md-12 mb-2">
                                        <textarea id="css-editor" name="configuracao[css_editor]" rows="10" class="form-control">{{ old('configuracao[css_editor]', $item->configuracao['css_editor'] ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>                    
                </div>

                                                

                <div class="mt-6 w-100 flex items-center gap-4">
                    <a href="javascript:;" onclick="parent.$.colorbox.close();" class="btn btn-secondary">Fechar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>                
            </form>            
        </main>
    </body>
</html>
<script>
    Dropzone.autoDiscover = false;

    const dzElement = document.getElementById("imageDropzone");

    const dz = new Dropzone(dzElement, {
        url: "{{route('admin.upload.temp')}}", 
        paramName: "image",
        maxFiles: 1,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictRemoveFile: "Remover imagem",
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        }                        
    });

    /* IMAGEM VINDO DO BANCO */
    const existingImage = dzElement.dataset.image;

    if (existingImage) {
        const mockFile = { name: "Imagem atual", size: 123456 };

        dz.emit("addedfile", mockFile);
        dz.emit("thumbnail", mockFile, existingImage);
        dz.emit("complete", mockFile);

        dz.files.push(mockFile);
    }

    /* MARCA REMOÇÃO */
    dz.on("removedfile", function () {
        const temp = document.getElementById("imagePath").value;

        if (temp) {
            fetch("{{route('admin.upload.temp.delete')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ path: temp })
            });

            document.getElementById("imagePath").value = "";
        }
    });

    dz.on("success", function (file, response) {
        document.getElementById("imagePath").value = response.path;
    });
</script>

<script>
document.querySelectorAll('.js-background-picker').forEach(picker => {

    const preview = picker.querySelector('.js-bg-preview');
    const radios = picker.querySelectorAll('.bg_type');

    const selectBg = picker.querySelector('.js-bg-select');

    const solidBox = picker.querySelector('.solid-options');
    const gradientBox = picker.querySelector('.gradient-options');

    const solidColor = picker.querySelector('[name*="background_solid_color"]');
    const gradColors = picker.querySelectorAll('.gradientColor');
    const gradDirection = picker.querySelector('.gradientDirection');
    const addConfiguracaoBackground = picker.querySelector('.addConfiguracaoBackground');
    const inputBackgroundName = picker.querySelector('.inputBackgroundName');

    function applyPreview() {
        const type = picker.querySelector('.bg_type:checked')?.value;

        solidBox.style.display = type === 'solid' ? 'block' : 'none';
        gradientBox.style.display = type === 'gradient' ? 'block' : 'none';

        if (type === 'salvo' && selectBg.value) {
            preview.style.cssText = selectBg.value;
        }

        if (type === 'solid' && solidColor) {
            selectBg.selectedIndex = 0;
            preview.style.background = solidColor.value;
        }

        if (type === 'gradient' && gradColors.length === 2) {
            selectBg.selectedIndex = 0;
            preview.style.background =
                `linear-gradient(${gradDirection.value}, ${gradColors[0].value}, ${gradColors[1].value})`;
        }
    }

    radios.forEach(r => r.addEventListener('change', applyPreview));
    selectBg?.addEventListener('change', applyPreview);
    solidColor?.addEventListener('input', applyPreview);
    gradColors.forEach(c => c.addEventListener('input', applyPreview));
    gradDirection?.addEventListener('change', applyPreview);

    addConfiguracaoBackground.addEventListener('click', () => {        
        inputBackgroundName.classList.remove('hidden');
        inputBackgroundName.classList.add('show');
    });

    applyPreview(); // inicializa com old / banco
});
</script>
<script>
    document.querySelectorAll('.js-toggle-icon').forEach(toggle => {
        toggle.addEventListener('click', () => {

            const container = toggle.closest('.toggle-container');
            if (!container) return;

            const content = container.querySelector('.js-toggle-content');
            if (!content) return;

            toggle.classList.toggle('is-open');
            content.classList.toggle('is-open');

        });
    });
</script>
<script>
    document.querySelectorAll('.btn-add-card').forEach(button => {
        button.addEventListener('click', () => {
            const countInput = document.getElementById('cardCount');
            let count = parseInt(countInput.value);
            //const container = button.closest('.toggle-content');
            //if (!container) return;
            const container = document.getElementById('cards-container');

            const newCard = document.createElement('div');
            newCard.classList.add('card-sortable', 'p-4');
            newCard.innerHTML = `
                <div class="col-md-12 mb-2">
                    <label for="configuracao[cards][${count}][title]" class="form-label">Título <b class="small">(h3)</b></label>
                    <i class="fa fa-trash cursor-pointer float-end btn-remove-card me-2" title="Remover Card"></i>
                    <i class="fa fa-arrows-alt cursor-move btn-move-card float-end me-2" title="Arrastar para reordenar"></i>
                    <i class="fa fa-minus-square cursor-pointer float-end btn-minus-card me-2" title="Minimizar Card"></i>
                    <input type="text" name="configuracao[cards][${count}][title]" class="form-control" value="">
                </div>
                <div class="tabs" id="tab-${count}">
                    <div class="tabs-header">
                        <a class="tab-btn active" data-tab="tab-${count}-card">Card</a>
                        <a class="tab-btn" data-tab="tab-${count}-button">Botão</a>
                        <a class="tab-btn" data-tab="tab-${count}-image">Imagem</a>
                    </div>

                    <div class="tabs-body">
                        <div class="tab-content active" id="tab-${count}-card">
                            <div class="col-md-12 mb-2 div-minus-card">
                                <label for="configuracao[cards][${count}][subtitulo2]" class="form-label">Subtítulo <b class="small">(h4)</b></label>
                                <input type="text" name="configuracao[cards][${count}][subtitulo2]" class="form-control" value="">
                            </div>
                            <div class="col-md-12 mb-2 div-minus-card">
                                <label for="configuracao[cards][${count}][subtitulo3]" class="form-label">Subtítulo <b class="small">(h5)</b></label>
                                <input type="text" name="configuracao[cards][${count}][subtitulo3]" class="form-control" value="">
                            </div>
                            <div class="col-md-12 mb-2 div-minus-card">
                                <label for="configuracao[cards][${count}][descricao]" class="form-label">Descrição</label>
                                <textarea name="configuracao[cards][${count}][descricao]" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="tab-content" id="tab-${count}-button">
                            <div class="col-md-12 mb-2 div-minus-card">                                        
                                <div class="row mb-3">                                        
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label">Texto do botão</label>                                            
                                        <input type="text" name="configuracao[cards][${count}][button][text]" placeholder="Texto" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label">Link do botão</label>                                            
                                        <input type="text" name="configuracao[cards][${count}][button][link]" placeholder="Link" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Background Color</label>                                            
                                        <input type="color" name="configuracao[cards][${count}][button][background]" placeholder="Cor do Botão" class="form-control form-control-color" style="height: 25px;">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Cor do Texto </label>                                            
                                        <input type="color" name="configuracao[cards][${count}][button][color]" placeholder="Cor do Texto" class="form-control form-control-color" style="height: 25px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-content" id="tab-${count}-image">
                            <div class="col-md-12 mb-2 div-minus-card">
                                <label for="configuracao[cards][${count}][image]" class="form-label">Selecione uma imagem</label>
                                <input type="file" name="configuracao[cards][${count}][image]" class="form-control upload-image-card" accept="image/*" id="inputGroupFile${count}">
                                <div class="preview-image mt-2">
                                    <img src="" alt="Preview" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                </div>
                            </div>
                            <div class="col-md-12 mb-2 div-minus-card">
                                <label for="configuracao[cards][${count}][icone]" class="form-label">Svg</label>
                                <input type="text" name="configuracao[cards][${count}][icone]" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                </div>
            
                
                
                
            `;

            container.appendChild(newCard);
            //container.insertBefore(newCard, button);
            document.getElementById('cardCount').value = parseInt(count +1);
        });
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-remove-card')) {
            const cardToRemove = event.target.closest('div.card-sortable');
            if (cardToRemove) {
                cardToRemove.remove();
            }
        }
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-minus-card')) {
            const card = event.target.closest('div.card-sortable');
            if (card) {
                const divsToToggle = card.querySelectorAll('.div-minus-card');
                divsToToggle.forEach(div => {
                    div.style.display = div.style.display === 'none' ? 'block' : 'none';
                });
                event.target.classList.toggle('fa-plus-square');
                event.target.classList.toggle('fa-minus-square');
                event.target.title = event.target.classList.contains('fa-plus-square') ? 'Maximizar Card' : 'Minimizar Card';
            }
        }
    });
</script>

<script>
  new Sortable(document.getElementById('cards-container'), {
    animation: 200,
    handle: '.btn-move-card', // só arrasta pelo botão
    draggable: '.card-sortable',
    ghostClass: 'drag-ghost',
    chosenClass: 'drag-chosen',
    onEnd: function () {
      atualizarIndexCards();
    }
  });

  function atualizarIndexCards() {
    document.querySelectorAll('#cards-container .card-sortable').forEach((card, index) => {

      card.querySelectorAll('input, textarea').forEach(field => {
        field.name = field.name.replace(/cards\]\[\d+\]/, `cards][${index}]`);
      });
    });

    document.getElementById('cardCount').value = document.querySelectorAll('#cards-container .card-sortable').length;
  }
</script>


<script>
document.addEventListener('click', function (e) {

  const btn = e.target.closest('.tab-btn');
  if (!btn) return;

  const tabsContainer = btn.closest('.tabs');
  if (!tabsContainer) return;

  const target = btn.dataset.tab;

  const buttons = tabsContainer.querySelectorAll(':scope > .tabs-header .tab-btn');
  const contents = tabsContainer.querySelectorAll(':scope > .tabs-body > .tab-content');

  buttons.forEach(b => b.classList.remove('active'));
  contents.forEach(c => c.classList.remove('active'));

  btn.classList.add('active');

  const targetEl = tabsContainer.querySelector('#' + target);
  if (targetEl) {
    targetEl.classList.add('active');
  }

});
</script>

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
    document.querySelectorAll('.js-button-select').forEach(select => {
        select.addEventListener('change', function () {

            if (!this.value) return;

            // pega o container pai
            const wrapper = this.closest('.button-config');
            if (!wrapper) return;

            const bgInput = wrapper.querySelector('.js-button-background-input');
            const colorInput = wrapper.querySelector('.js-button-color-input');

            // extrai background e color do value
            const bgMatch = this.value.match(/background:\s*(#[0-9a-fA-F]{6})/);
            const colorMatch = this.value.match(/color:\s*(#[0-9a-fA-F]{6})/);

            if (bgMatch && bgInput) {
                bgInput.value = bgMatch[1];
            }

            if (colorMatch && colorInput) {
                colorInput.value = colorMatch[1];
            }
        });
    });
</script>

<script>
    const select = document.getElementById('tipo_bloco');
    
    select.addEventListener('change', function () {
        const option = this.options[this.selectedIndex];
    
        const idFormHubSpot = document.getElementById('idFormHubSpot');
        idFormHubSpot.style.display = (option.value == 'btn-whatsapp-custom-chat-hubspot' || option.value == 'form-custom-chat-hubspot' || option.value == 'form-custom-hubspot' || option.value == 'btn-whatsapp-custom-hubspot') ? 'block' : 'none';
    });
</script>

<script>
document.querySelectorAll('.color-toggle').forEach(wrapper => {
  const checkbox = wrapper.querySelector('.js-toggle-color');

  const syncState = () => {
    const allColorInputs = document.querySelectorAll('.js-color-input');

    allColorInputs.forEach(input => {
      if (!checkbox.checked) {
        input.disabled = true;
        input.value = '';
      } else {
        input.disabled = false;
      }
    });
  };

  // Estado inicial
  syncState();

  checkbox.addEventListener('change', syncState);
});
</script>
<script>
const editor = CodeMirror.fromTextArea(
    document.getElementById("css-editor"),
        {
            mode: "css",
            lineNumbers: true,
            theme: "default"
        }
);
</script>