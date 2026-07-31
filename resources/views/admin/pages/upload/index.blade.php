@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.upload')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3"><?=sortLink('name', 'Nome');?></th>
                <th class="py-3"><?=sortLink('file', 'Arquivo');?></th>
                <th class="py-3"><?=sortLink('created_at', 'Data');?></th>
                <x-actions-td/>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="verDetalhes border-b hover:bg-gray-50" id="row-{{ $item->id }}">
                <td class="py-3">{{ $item->name }}</td>
                <td class="py-3" style="color:#0040cf;"><a href="{{ asset('storage/' . $item->file) }}" target="_blank">{{ $item->file }}</a></td>
                <td class="py-3">{{ $item->created_at->format('d/m/Y H:i') }}</td>                            
                <x-actions-td-buttom :item="$item"/>            
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.layouts.pagination-items')
</div>
@endsection