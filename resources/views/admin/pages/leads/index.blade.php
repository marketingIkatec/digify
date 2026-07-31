@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.leads')

<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3">{!! sortLink('id', 'Id') !!}</th>
                <th class="py-3">{!! sortLink('nome', 'Nome') !!}</th>
                <th class="py-3">{!! sortLink('email', 'E-mail') !!}</th>
                <th class="py-3">Celular</th>
                <th class="py-3">{!! sortLink('form_type', 'Formulário') !!}</th>
                <th class="py-3">{!! sortLink('status', 'Status') !!}</th>
                <th class="py-3">{!! sortLink('created_at', 'Data') !!}</th>
                <th class="py-3"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($leads as $lead)
            <tr class="verDetalhes border-b hover:bg-gray-50 cursor-pointer"            
                     data-info='@json($lead->extra_data_label)'
            >
                <td class="py-3">{{ $lead->id }}</td>
                <td class="py-3">{{ $lead->nome }} {{ $lead->sobrenome }}</td>
                <td class="py-3">{{ $lead->email }}</td>
                <td class="py-3">{{ $lead->celular }}{{ $lead->whatsapp }}</td>
                <td class="py-3">{!! $lead->form_type !!}</td>
                <td class="py-3">{!! $lead->status_label !!}</td>
                
                <td class="py-3">{{ $lead->created_at_br }}</td>
                @php 
                  if(request()->route()->getName() == 'admin.lead.contato'){
                    $routeName = 'admin.send-contato-hubspot';
                  } elseif(request()->route()->getName() == 'admin.lead.whatsapp'){
                    $routeName = 'admin.send-whatsapp-hubspot'; 
                  }elseif(request()->route()->getName() == 'admin.lead.custom'){
                    $routeName = 'admin.send-custom-hubspot'; 
                  }
                @endphp
                <td class="py-3"><a href="{{route($routeName, $lead->id)}}" title="Enviar lead para a HubSpot" target="_blank"><x-heroicon-o-identification class="w-5 h-5" /></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- Paginação --}}
    <div class="mt-4">
        <div class="flex-md-row justify-content-between align-items-center gap-2">            
            <div>
                {{ $leads->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>
@endsection
<div id="modalDetalhes" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded p-6 w-[400px]">
        <h3 class="text-lg font-semibold mb-3">Detalhes do Lead</h3>

        <div id="mCampos" class="space-y-2"></div>

        <div class="text-right mt-4">
            <button id="fecharModal" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Fechar
            </button>
        </div>
    </div>
</div>

