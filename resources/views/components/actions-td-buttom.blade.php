@can('edit-route', Route::currentRouteName())
    @if(!empty($item->slug))
        @php
            $routeUrl = getRouteUrl($item);
        @endphp    
        <td class="img-action w1">
            <a href="{{$routeUrl['slug']}}" title="{{$routeUrl['title']}}" target="_blank" class="btn btn-sm">
                <img src="{{asset('build/images/admin/globe.png') }}" title="{{ $routeUrl['title'] }}">
            </a>
        </td>
    @endif

    @if(isset($item->status) && (is_numeric($item->status) || is_bool($item->status)))
        <td class="img-action w1">
            <livewire:admin-status-model
                :item="$item"
                field="status"
                :routeName="Route::currentRouteName()"
                :wire:key="'status-'.$item->id"
            />
        </td>
    @endif
    <td class="img-action w1">
        <a href="{{ route($actionRoute['edit'], $item) }}" class="btn btn-sm">
            <img src="{{asset('build/images/admin/edit.png')}}" title="Editar {{$item->display_name}}">
        </a>
    </td>
@endcan

@can('delete-route', Route::currentRouteName())
    <td class="img-action w1">
         <livewire:admin-delete-model
            :item="$item"
            :routeName="Route::currentRouteName()"
            :wire:key="'delete-'.$item->id"
        />
    </td>
@endcan