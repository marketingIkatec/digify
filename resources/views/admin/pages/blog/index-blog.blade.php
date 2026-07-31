@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.blog')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3">Imagem de Capa</th>
                <th class="py-3"><?=sortLink('titulo', 'Titulo');?></th>
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
                <td class="py-3 cursor-pointer">
                    <b>{{ $item->titulo }}</b>
                    <p style="text-align: justify">{{ $item->resumo }}</p>
                    <b>Data de Publicação: </b>{{ ($item->data_blog) ? $item->data_blog->format('d/m/Y') : ''}}</b><br>
                    <b>Total de Visitas: </b>{{ $item->total_visitas }}
                </td>                
                <x-actions-td-buttom :item="$item"/>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.layouts.pagination-items')
</div>
@endsection
