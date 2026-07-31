<div class="row mb-5">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800 col-md-6">{{(!empty($item) && $item->id) ? 'Editar '.$item->display_name : 'Cadastrar '.$currentMenu['titulo_do_menu'] }}</h1>
        
        <div class="d-flex align-items-center gap-3">
            @if(!empty($isStatus) and $isStatus)
                <div class="toggle-switch">
                    <label class="switch">
                        <input type="checkbox" id="statusToggle" {{ old('status', $item->status ?? 1) == 1 ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                    <span class="ms-2 align-middle">Status (Inativo/ Ativo)</span>
                    <input type="hidden" name="status" id="status" value="{{ old('status', $item->status ?? 1) }}">
                </div>
            @endif            

            <div>
                <a href="{{ route($actionRoute['index']) }}" class="btn btn-secondary btn-sm">Voltar</a>
                
                @if(!empty($item) && !empty($item->slug))
                    @php
                        $routeUrl = getRouteUrl($item);
                    @endphp 
                    <a href={{$routeUrl['slug']}} target="_blank" class="btn btn-info btn-sm">Acessar Página</a>
                @endif
                
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            </div>
        </div>
    </div>
</div>