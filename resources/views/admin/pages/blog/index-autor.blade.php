@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.blog-autor')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3">Foto</th>
                <th class="py-3"><?=sortLink('autor', 'Autor');?></th>
                <th class="py-3"><?=sortLink('slug', 'URL');?></th>
                <x-actions-td/>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="verDetalhes border-b hover:bg-gray-50" id="row-{{ $item->id }}">
                <td class="py-3" style="width: 150px">
                    @if(isset($item) && $item->imagem)
                        <img src="{{ asset('storage/'.$item->imagem) }}" style="width: 150px;" class="img-fluid rounded-3">
                    @endif
                </td>
                <td class="py-3">{{ $item->autor }}<br><small>{!! $item->resumo !!}</small></td>
                <td class="py-3">{{ $item->slug }}</td>                                
                <x-actions-td-buttom :item="$item"/>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.layouts.pagination-items')

</div>
@endsection