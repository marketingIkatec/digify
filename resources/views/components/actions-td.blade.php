{{--
@if (!empty($permissions['options']['verSite']))
    <td class="w1">&nbsp;</td>
@endif
--}}
@can('edit-route', Route::currentRouteName())
    @if(isset($item->status) && is_numeric($item->status))
        <td class="w1">&nbsp;</td>
    @endif
    <td class="w1">&nbsp;</td>
@endcan
@can('delete-route', Route::currentRouteName())
    <td class="w1">&nbsp;</td>
@endcan