@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.setting-menu')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3"><?=sortLink('menu', 'Menu');?></th>
                <th class="py-3">Slug</th>                            
                <x-actions-td/>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="mostraDetalhes border-b hover:bg-gray-50" id="row-{{ $item->id }}">
                <td class="py-3 cursor-pointer flex flex-row gap-1 items-center">{!! $item->icone !!} {{ $item->menu }}</td>                                
                <td class="py-3 cursor-pointer">{{ $item->route }}</td>                                
                <x-actions-td-buttom :item="$item"/>
            </tr>
            <tr id="detalhes-row-{{ $item->id }}">
                <td colspan="5" class="p-0">
                    <div class="detalhes hidden" id="detalhe-{{ $item->id }}">
                        <div class="p-4 bg-gray-50">
                            @if ($item->children->count() > 0)                        
                                <table>
                                    <tr>
                                        <th class="text-left p-2 bg-gray-100">Menu</th>
                                        <th class="text-left bg-gray-100">Slug</th>
                                        <th class="text-left bg-gray-100"></th>
                                        <th class="text-left bg-gray-100"></th>
                                    </tr>
                                    @foreach($item->children as $child)
                                        <tr>
                                            <td class="p-4 flex flex-row gap-1 items-center">
                                                {!! $child->icone !!}
                                                {{ $child->menu }}
                                            </td>
                                            <td class="p-4">{{ $child->route }}</td>
                                            <x-actions-td-buttom :item="$child"/>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.layouts.pagination-items')

</div>
@endsection