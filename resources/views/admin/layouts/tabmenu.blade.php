<div class="mb-4 flex items-center justify-between">
    @php
        $currentMenuChildren = getCurrentMenuChildren();
        
    @endphp
    @if(!empty($currentMenuChildren) && count($currentMenuChildren))  
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            @foreach ($currentMenuChildren as $menu)
                @php 
                    $active = Route::currentRouteName() === $menu['route'] ? 'active' : '';
                    echo '  <li class="nav-item" role="presentation">';
                    echo '    <a href="'.route($menu['route']).'" class="nav-link '.$active.'" type="button" role="tab" aria-controls="'.strtolower($menu['menu']).'-tab-pane" '.($active ? 'aria-selected="true"' : '').'>'.$menu['icone'].' '.$menu['menu'].'</a>';
                    echo '  </li>';
                @endphp                    
            @endforeach
        </ul>
    @elseif(!empty($currentMenu))
        <h2 class="text-xl font-semibold">{{$currentMenu['menu']}}</h2> 
    @endif    

    @if(!empty($permissionRoute))
        <div class="d-flex gap-2 justify-content-end">
            @if(!empty($currentMenu['is_search']) && $currentMenu['is_search'])     
                <a href="javascript:;" id="toggleSearch" class="btn btn-secondary btn-sm flex">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                    Buscar
                </a>
            @endif
            @can('create-route', Route::currentRouteName())
                @if (Route::has($actionRoute['create']))
                    <a href="{{route($actionRoute['create'])}}" id="cadastrar" class="btn btn-secondary btn-sm flex">
                        <x-heroicon-o-plus class="w-5 h-5" />
                        Cadastrar
                    </a>
                @endif
                @if (Route::has($actionRoute['report']))
                    <a href="{{route($actionRoute['report'])}}" id="cadastrar" class="btn btn-secondary btn-sm flex">
                        <x-heroicon-o-chart-bar class="w-5 h-5" />
                        Relatório
                    </a> 
                @endif
            @endcan
            @if(!empty($currentMenu['is_search']) && $currentMenu['is_search'])
                <a href="{{route($actionRoute['index'])}}" id="recarregar" class="btn btn-secondary btn-sm flex">
                    <x-heroicon-o-arrow-path class="w-5 h-5" />
                    Recarregar
                </a>
            @endif
        </div>
    @endif
</div>