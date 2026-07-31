@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.setting-popup')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3"><?=sortLink('nome', 'Nome');?></th>
                <th class="py-3"><?=sortLink('popup', 'Id Popup');?></th>                             
                <th class="py-3">Tipo</th>
                <x-actions-td/>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="verDetalhes border-b hover:bg-gray-50" id="row-{{ $item->id }}">
                <td class="py-3">{{ $item->nome }}</td>
                <td class="py-3">{{ $item->popup }}</td>
                <td class="py-3">{{ $item->tipo }}</td>
                <x-actions-td-buttom :item="$item"/>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.layouts.pagination-items')

</div>
@endsection