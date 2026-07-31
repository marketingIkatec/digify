@extends('admin.app')

@section('content')
    <form action="{{ route('admin.site.upload.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ old('id', $item->id ?? '') }}" name="id" id="id">
              
    <x-actions-save-cancel :isStatus="true" :item="$item ?? false" />   

    <div class="row mb-5">
        <div class="col-md-6 space-y-6">

            <div class="bg-white shadow-sm sm:rounded-lg h-100">                
                <div class="bg-gray-800 rounded-top p-1">
                    <span class="title ps-2 text-white text-lg font-medium">
                        <i class="fa fa-upload"></i> 
                        Upload de Arquivos
                    </span>
                </div>                
                
                <div class="p-4 sm:p-8">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" class="form-control onloadUrl equalsMetaTitle @error('name') is-invalid @enderror" value="{{ old('name', $item->name ?? '') }}">
                            @error('name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="file" class="form-label">Arquivo</label>
                            <input type="file" name="file" class="form-control" value="{{ old('file', $item->file ?? '') }}">
                        </div>    

                    </div>
                    
                    
                    <div class="mt-6 flex items-center gap-2">
                        <a href="{{ route('admin.site.upload.index') }}" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection


