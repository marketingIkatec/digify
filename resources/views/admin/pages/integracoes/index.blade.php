@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.integracoes-categoria')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3"><?=sortLink('categoria', 'Categoria');?></th>
                <th class="py-3"><?=sortLink('slug', 'URL');?></th>
                <x-actions-td/>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="verDetalhes border-b hover:bg-gray-50" id="row-{{ $item->id }}">
                <td class="py-3">{{ $item->categoria }}<br><small>{{$item->resumo}}</small></td>
                <td class="py-3">{{ $item->slug }}</td>                                
                <x-actions-td-buttom :item="$item"/>            
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.layouts.pagination-items')
</div>
@endsection