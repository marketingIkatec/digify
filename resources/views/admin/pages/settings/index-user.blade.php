@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.setting-user')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3">Id</th>
                <th class="py-3"><?=sortLink('name', 'Nome');?></th>                
                <th class="py-3"><?=sortLink('email', 'E-mail');?></th>                
                <th class="py-3 text-center"><?=sortLink('is_master_admin', 'Master Admin');?></th>                
                <th class="py-3"><?=sortLink('last_login', 'Último Login');?></th>
                <th class="py-3"><?=sortLink('created_at', 'Data de Cadastro');?></th>
                <x-actions-td/>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="verDetalhes border-b hover:bg-gray-50" id="row-{{ $item->id }}">
                <td class="py-3">{{ $item->id }}</td>                                
                <td class="py-3">{{ $item->name }}</td>                                
                <td class="py-3">{{ $item->email }}</td>                                
                <td class="py-3 text-center">{!! $item->is_master_admin ? '<i class="fa fa-check-square" aria-hidden="true"></i>' : '' !!}</td>                                
                <td class="py-3 text-center">{{  $item->last_login ? $item->last_login->format('d/m/Y H:i') : 'Nunca' }}</td>                                
                <td class="py-3 text-center">{{  $item->created_at->format('d/m/Y') }}</td>                                
                <x-actions-td-buttom :item="$item"/>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.layouts.pagination-items')

</div>
@endsection