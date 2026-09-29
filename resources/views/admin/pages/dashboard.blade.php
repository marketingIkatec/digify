@extends('admin.app')

@section('content')
 <style>
    #container-barra {
      width: 100%;
      height: 400px;
      margin: 2rem auto;
    }
    #container-origem {
      width: 100%;
      height: 440px;
      margin: 2rem auto;
    }
    .highcharts-credits{
        display: none;
    }
  </style>
<!-- Carrega o Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<div class="content">
    <div class="">

        {{-- FILTRO --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover mb-4 p-3">
                    
                    <form name="frm_filtro" id="frm_filtro" method="GET">
                        <div class="row align-items-end">

                            {{-- PERÍODO --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Período</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input 
                                                type="date" 
                                                class="form-control" 
                                                name="dataInicial" 
                                                id="dataInicial"
                                                value="{{ request('dataInicial') ?? date('Y-m-d') }}"
                                            >
                                        </div>
                                        <div class="col-6">
                                            <input 
                                                type="date" 
                                                class="form-control" 
                                                name="dataFinal" 
                                                id="dataFinal"
                                                value="{{ request('dataFinal') ?? date('Y-m-d') }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- PÁGINA --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Página</label>
                                    <select name="tipoPagina" id="tipoPagina" class="form-control">
                                        <option value="">Selecione o tipo da Página</option>

                                        @if(!empty($paginas))
                                            @foreach($paginas as $pagina)
                                                <option 
                                                    value="{{ $pagina->pagina }}"
                                                    {{ request('tipoPagina') == $pagina->pagina ? 'selected' : '' }}
                                                >
                                                    {{ $pagina->pagina }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            {{-- BOTÃO --}}
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button 
                                        type="submit" 
                                        class="btn btn-info btn-fill w-100"
                                    >
                                        Buscar
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- GRÁFICO 
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="width: 100%">
                        <div id="container-barra"></div>
                    </div>
                </div>
            </div>
        </div>
        --}}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="width: 100%">
                        <div id="container-origem"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="content mt-4">
	


<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3">Id</th>
              
                <th class="py-3"><?=sortLink('pais', 'pais');?></th>
                <th class="py-3"><?=sortLink('regiao', 'regiao');?></th>
                <th class="py-3"><?=sortLink('latitude', 'latitude');?></th>
                <th class="py-3"><?=sortLink('longitude', 'longitude');?></th>
                <th class="py-3"><?=sortLink('cidade', 'cidade');?></th>
                <th class="py-3"><?=sortLink('pagina', 'pagina');?></th>
                <th class="py-3"><?=sortLink('data', 'data');?></th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="verDetalhes border-b hover:bg-gray-50">
                <td class="py-3">{{ $item->id }}</td>                                
                                            
                <td class="py-3">{{ $item->pais }}</td>                                
                <td class="py-3">{{ $item->regiao }}</td>                                
                <td class="py-3">{{ $item->latitude }}</td>                                
                <td class="py-3">{{ $item->longitude }}</td>                                
                <td class="py-3">{{ $item->cidade }}</td>                                
                <td class="py-3">{{ $item->pagina_nome }}</td>                                                               
                <td class="py-3">{{ $item->data_br }}</td>                                
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- Paginação --}}
    <div class="mt-4">
        {{ $items->links() }}
    </div>
</div>
</div>

<!-- Depois cria o gráfico -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    /*Highcharts.chart('container-barra', {
      chart: {
        type: 'column'
      },
      title: {
        text: '10 paginas mais visitadas'
      },
      xAxis: {
        categories: [
			@php
			if(!empty($graficos['graficoVisitaTotal']['grafico'])){
				foreach($graficos['graficoVisitaTotal']['grafico'] as $grafico){@endphp
					'{{ $grafico["pagina"] }}', 
				@php }
			}
			@endphp
		],
        title: { text: null }
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Visitas',
          align: 'high'
        },
        labels: {
          overflow: 'justify'
        }
      },
      tooltip: {
        valueSuffix: ''
      },
      plotOptions: {
        bar: {
          dataLabels: {
            enabled: true
          }
        }
      },
      series: [{
		name: 'Qtde de Visitas',
        data: [
			@php
			if(!empty($graficos['graficoVisitaTotal']['grafico'])){
				foreach($graficos['graficoVisitaTotal']['grafico'] as $grafico){@endphp
					{{ $grafico["total"] }}, 
				@php }
			}
			@endphp
		]
      }]
    });*/

    Highcharts.chart('container-origem', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Origem das 10 paginas mais visitadas'
      },
      xAxis: {
        categories: [
            @php
            if(!empty($graficos['graficoVisitaTotal']['grafico'])){
                foreach($graficos['graficoVisitaTotal']['grafico'] as $grafico){@endphp
                    '{{ $grafico["pagina"] }}',
                @php }
            }
            @endphp
        ]
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Visitas'
        },
        stackLabels: {
          enabled: true
        }
      },
      tooltip: {
        shared: true
      },
      plotOptions: {
        column: {
          stacking: 'normal',
          dataLabels: {
            enabled: true
          }
        }
      },
      series: [{
        name: 'Orgânico',
        data: [
            @php
            if(!empty($graficos['graficoVisitaTotal']['grafico'])){
                foreach($graficos['graficoVisitaTotal']['grafico'] as $grafico){@endphp
                    {{ $grafico["organico"] ?? 0 }},
                @php }
            }
            @endphp
        ]
      }, {
        name: 'Campanha',
        data: [
            @php
            if(!empty($graficos['graficoVisitaTotal']['grafico'])){
                foreach($graficos['graficoVisitaTotal']['grafico'] as $grafico){@endphp
                    {{ $grafico["campanha"] ?? 0 }},
                @php }
            }
            @endphp
        ]
      }]
    });
});
</script>
@endsection
