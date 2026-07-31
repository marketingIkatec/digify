@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.setting-hubspot')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3"><?=sortLink('name', 'Nome');?></th>
                <th class="py-3"><?=sortLink('form_name', 'Nome na HubSpot');?></th>                             
                <th class="py-3">Titulo do Botão</th>
                <th class="py-3">Embedded</th>
                <x-actions-td/>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="verDetalhes border-b hover:bg-gray-50" id="row-{{ $item->id }}">
                <td class="py-3">{{ $item->name }}</td>
                <td class="py-3">
                    {{ $item->form_name }}<br>
                    <a href="https://app.hubspot.com/forms/{{ $config['hubspot_portal_id'] }}/new-editor/{{ $item->form_id }}" target="_blank" style="color: rgba(var(--bs-link-color-rgb),var(--bs-link-opacity,1));">{{ $item->form_id }}</a>
                </td>
                <td class="py-3"><a href="javascript:;" class="btn btn-primary btn-sm btn-" style="width: 100%;">{{ $item->form_title_button }}</a></td>  
                <td class="py-3">{!! $item->form_embedded ? '<i class="fa fa-check-square" aria-hidden="true"></i>' : '' !!}</td>                                
                <x-actions-td-buttom :item="$item"/>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.layouts.pagination-items')

</div>
@endsection