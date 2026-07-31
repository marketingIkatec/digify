@extends('admin.app')

@section('content')
    <form action="{{ route('admin.setting.menu.store') }}" method="POST">
    @csrf
    <input type="hidden" value="{{ old('id', $item->id ?? '') }}" name="id" id="id">

    <x-actions-save-cancel :isStatus="false" :item="$item ?? false" />    

    <div class="row mb-5">
        <div class="col-md-12 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg h-100">                
                <div class="bg-gray-800 rounded-top p-1">
                    <span class="title ps-2 text-white text-lg font-medium">
                        <i class="fa fa-list"></i> 
                        Menu Administrativo
                    </span>
                </div>               
                
                <div class="p-4 sm:p-8">
                    <div class="row">                    
                        <div class="col-md-4 mb-3">
                            <label for="menu" class="form-label">Menu</label>
                            <input type="text" name="menu" class="form-control @error('menu') is-invalid @enderror" value="{{ old('menu', $item->menu ?? '') }}">
                            @error('menu') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="menu_id" class="form-label">Menu Pai</label>
                            <select id="menu_id" name="menu_id" class="form-control @error('menu_id') is-invalid @enderror">
                                <option value="0">Selecione</option>
                                @if(!empty($menuPai))
                                    @foreach($menuPai as $menu)
                                        <option value="{{ $menu->id }}" {{ old('menu_id', $item->menu_id ?? '') == $menu->id ? 'selected' : '' }}>
                                            {{ $menu->menu }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('menu_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="titulo_do_menu" class="form-label">Título do Menu</label>
                            <input type="text" name="titulo_do_menu" class="form-control @error('titulo_do_menu') is-invalid @enderror" value="{{ old('titulo_do_menu', $item->titulo_do_menu ?? '') }}">
                            @error('titulo_do_menu') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="icone" class="form-label">Ícone</label>
                            <input type="text" name="icone" class="form-control @error('icone') is-invalid @enderror" value="{{ old('icone', $item->icone ?? '') }}">
                            @error('icone') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="ordem" class="form-label">Ordem</label>
                            <input type="text" id="ordem" name="ordem" class="form-control @error('ordem') is-invalid @enderror" value="{{ old('ordem', $item->ordem ?? '') }}">
                            @error('ordem') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="route" class="form-label">Route</label>
                            <input type="text" name="route" class="form-control @error('route') is-invalid @enderror" value="{{ old('route', $item->route ?? '') }}">
                            @error('route') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>                        
                    </div>
                    <div class="row">
                        
                        <div class="col-md-4">
                            <label for="is_search" class="form-label">Search</label>
                            <select id="is_search" name="is_search" class="form-control @error('is_search') is-invalid @enderror">
                                <option value="1" {{ old('is_search', $item->is_search ?? '') == 1 ? 'selected' : '' }}>Sim</option>
                                <option value="0" {{ old('is_search', $item->is_search ?? '') == 0 ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>

                    </div>
                    
                    <div class="mt-6 flex items-center gap-2">
                        <a href="{{ route('admin.setting.menu.index') }}" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
            <!-- Configurações Gerais do Site --> 
        </div>
    </div>
</form>

@endsection


