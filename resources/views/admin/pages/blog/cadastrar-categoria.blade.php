@extends('admin.app')

@section('css_js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <!-- jQuery + JS do Selectize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- CSS do Selectize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <form action="{{ route('admin.blog.categoria.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ old('id', $item->id ?? '') }}" name="id" id="id">
              
    <x-actions-save-cancel :isStatus="true" :item="$item ?? false" />   

    <div class="row mb-5">
        <div class="col-md-9 space-y-6">
            <!-- Configurações Gerais do Site --> 
            <div class="bg-white shadow-sm sm:rounded-lg h-100">                
                <div class="bg-gray-800 rounded-top p-1">
                    <span class="title ps-2 text-white text-lg font-medium">
                        <i class="fa fa-list"></i> 
                        Categoria do Blog
                    </span>
                </div>                
                
                <div class="p-4 sm:p-8">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="categoria" class="form-label">Categoria</label>
                            <input type="text" name="categoria" class="form-control onloadUrl equalsMetaTitle @error('categoria') is-invalid @enderror" value="{{ old('categoria', $item->categoria ?? '') }}">
                            @error('categoria') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                    </div>
                        
                    <div class="col-md-12">
                        <label for="resumo" class="form-label">Resumo</label>
                        <textarea name="resumo" class="form-control equalsMetaDescription" rows="2">{{ old('resumo', $item->resumo ?? '') }}</textarea>
                    </div> 
                    
                    <div class="mt-6 flex items-center gap-2">
                        <a href="{{ route('admin.blog.categoria.index') }}" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
            <!-- Configurações Gerais do Site --> 
        </div>
        <div class="col-md-3 space-y-6">
            <div class="image-upload card-right sm:rounded-lg">                
                <div class="card-right-header bg-gray-800 rounded-top p-1">
                    <span class="title ps-2 text-white">
                        <i class="fa fa-image"></i> 
                        Imagem de Capa da Categoria
                    </span>
                </div>
                <input type="file" name="imagem" id="imagem" class="upload-input hidden @error('imagem') is-invalid @enderror" accept="image/*">
                @error('imagem') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                
                <div class="upload-body">
                    <div class="preview-area btn-upload image-upload-wrapper position-relative" id="preview-area">
                        @if($imagem = $item->imagem ?? '')
                            <img src="{{ asset('storage/'.$imagem) }}" alt="Imagem de capa da categoria" class="img-fluid">
                        @else
                            <i class="fa fa-image preview-icon"></i>
                        @endif
                        <!-- Overlay no hover -->
                        <div class="overlay-text d-flex justify-content-center align-items-center">
                            <span>Selecione uma imagem</span>
                        </div>
                    </div>
                </div>                
            </div>

            <div class="card-right sm:rounded-lg">                
                <div class="card-right-header bg-gray-800 rounded-top p-1">
                    <span class="title ps-2 text-white">
                        <i class="fa fa-list"></i> 
                         SEO da Página 
                    </span>
                </div>
                
                
                <div>
                    <div class="p-4 sm:p-8">                        
                        <div class="col-md-12 mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $item->meta_title ?? '') }}">
                            @error('meta_title') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>                    
                        
                        <div class="col-md-12 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $item->slug ?? '') }}">
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
</form>

@endsection


