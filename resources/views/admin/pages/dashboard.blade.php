@extends('admin.app')

@section('content')
 <style>
    #container-barra {
      width: 100%;
      height: 400px;
      margin: 2rem auto;
    }
    .highcharts-credits{
        display: none;
    }
  </style>
<!-- Carrega o Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<div class="content">
    <div class="container-fluid">

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

        {{-- GRÁFICO --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="width: 100%">
                        <div id="container-barra"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

	


<div class="bg-white shadow rounded p-4">
    <table class="table table-striped table-hover">
        <thead class="border-b">
            <tr class="text-sm text-gray-600 uppercase">
                <th class="py-3">Id</th>
                <th class="py-3">Ip</th>
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
                <td class="py-3">{{ $item->ip }}</td>                                
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

<!-- Depois cria o gráfico -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    Highcharts.chart('container-barra', {
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
    });
});
</script>
@endsection


    {{--
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script> 
 
 <style>
    #container-barra {
      width: 100%;
      height: 400px;
      margin: 2rem auto;
    }
  </style>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card strpied-tabled-with-hover" style="padding:10px;">
					<form name="frm_filtro" id="frm_filtro" method = "GET">
						<div class="card-body">
							<div class="row">
								<div class="col-md-4 pr-1">
									<div class="form-group">
										<label>Período</label>
										<table>
											<tr>
												<td><input type="date" class="form-control" name="dataInicial" id="dataInicial" size="8" value="<?=$_GET['dataInicial'] ?? '';?>"></td>
												<td><input type="date" class="form-control" name="dataFinal" id="dataFinal" size="8" value=<?=$_GET['dataFinal'] ?? date('Y-m-d');?>></td>
											</tr>
										</table> 
									</div>
								</div>
								<div class="col-md-6 pr-1">
									<div class="form-group">
										<label>Pagina</label>										
										<select name="tipoPagina" id="tipoPagina" class="form-control">
											<option value = "">Selecione o tipo da Página</option>
											<option value = "blog" <?=((!empty($_GET['tipoPagina']) and $_GET['tipoPagina'] == 'blog') ? "selected" : "");?>>Tela Inicial - Blog</option>
											<option value = "blogs" <?=((!empty($_GET['tipoPagina']) and $_GET['tipoPagina'] == 'blogs') ? "selected" : "");?>>Blogs</option>
											<option value = "blogsCategoria" <?=((!empty($_GET['tipoPagina']) and $_GET['tipoPagina'] == 'blogsCategoria')? "selected" : "");?>>Categoria do Blog</option>
										</select>												
									</div>
								</div>		
								<div class="col-md-2 pl-1">
									<div class="form-group">
									<button type="submit" style="top:25px;position:relative;" class="btn btn-info btn-fill pull-right">Buscar</button>
									</div>
								</div>
							</div>
						</div>	
					</form>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card ">
					<div class="card-body ">
						<div id="container-barra"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>				

@endsection
<script>
    // ====== GRÁFICO DE BARRAS HORIZONTAIS ======
    Highcharts.chart('container-barra', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Visitas'
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
    });
  </script>
  --}}
