@extends('admin.app')

@section('css_js')
<!-- jQuery + JS do Selectize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- CSS do Selectize -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <form action="{{ route('admin.setting.popup.store') }}" method="POST">
    @csrf
    <input type="hidden" value="{{ old('id', $item->id ?? '') }}" name="id" id="id">

    <x-actions-save-cancel :isStatus="false" :item="$item ?? false" />    

    <div class="row">
        <div class="col-md-12">
            <div class="row mb-5">
                <div class="col-md-6">                
                    <div class="bg-gray-800 rounded-top p-1">
                        <span class="title ps-2 text-white text-lg font-medium">
                            <i class="fa fa-list"></i> 
                            Informações do Popup
                        </span>
                    </div>               
                    
                    <div class="p-4 sm:p-8 bg-white shadow">
                       
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nome" class="form-label">Nome do Popup</label>
                                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $item->nome ?? '') }}">
                                @error('nome') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="popup" class="form-label">Id do Popup</label>
                                <input type="text" name="popup" class="form-control @error('popup') is-invalid @enderror" value="{{ old('popup', $item->popup ?? '') }}">
                                @error('popup') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="tipo" class="form-label">Mostrar Popup</label>
                                <select name="tipo" class="form-select @error('tipo') is-invalid @enderror">
                                    <option value=""></option>
                                    <option value="saida" {{ old('tipo', $item->tipo ?? '') == 'saida' ? 'selected' : '' }}>Quando usuário sair da tela</option>
                                    <option value="entrada" {{ old('tipo', $item->tipo ?? '') == 'entrada' ? 'selected' : '' }}>Quando usuário entrar na tela</option>
                                </select>
                                @error('tipo') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">                
                    <div class="bg-gray-800 rounded-top p-1">
                        <span class="title ps-2 text-white text-lg font-medium">
                            <i class="fa fa-list"></i> 
                            Vincular
                        </span>
                    </div>               
                    
                    <div class="p-4 sm:p-8 bg-white shadow">
                       
                        <div class="row">
                            <div class="col-md-12">
                                <label for="pages" class="form-label">Paginas</label>
                                <select id="pages" name="pages[]" class="form-select input-selectize" multiple>
                                    @foreach($pages as $locale => $grupo)
                                        <optgroup label="{{ strtoupper($locale) }}">
                                            @foreach($grupo as $page)
                                                <option 
                                                    value="{{ $page->id }}"
                                                    @selected(in_array($page->id, old('pages', $pageIds ?? [])))
                                                >
                                                    {{ $page->titulo }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="blogs" class="form-label">Blogs</label>
                                <select id="blogs" name="blogs[]" class="form-select input-selectize" multiple>
                                    @foreach(\App\Models\Blog::orderBy('titulo')->get() as $blog)
                                        <option 
                                            value="{{ $blog->id }}"
                                            @selected(in_array($blog->id, old('blogs', $blogIds ?? [])))
                                        >
                                            {{ $blog->titulo }}
                                        </option>
                                    @endforeach
                                </select>	
                            </div>
                        </div>
                    </div>
                </div>
                   
                
                <!-- Configurações Gerais do Site --> 
                <div class="mt-6 flex items-center gap-2">
                    <a href="{{ route('admin.setting.popup.index') }}" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection


