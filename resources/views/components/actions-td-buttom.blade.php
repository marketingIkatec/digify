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
                :wire:key="'status-'.$item->id"
            />
        </td>
    @endif
    @if(Route::currentRouteName() === 'admin.setting.user.index')
        <td class="img-action w1">
            @if(auth()->user()?->is_master_admin)
                <form method="POST" action="{{ route('admin.setting.user.send.credentials', $item) }}" class="js-send-user-credentials" data-email="{{ $item->email }}">
                    @csrf
                    <button type="submit" class="btn btn-sm" title="Enviar acesso por e-mail">
                        <img src="{{ asset('build/images/admin/mail-inbox.png') }}" title="Enviar acesso por e-mail">
                    </button>
                </form>
            @endif
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
            :wire:key="'delete-'.$item->id"
        />
    </td>
@endcan
