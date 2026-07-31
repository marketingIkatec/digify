@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.leads')
<div class="bg-white shadow rounded p-4">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <style>
        h1{
            font-size: 24px;
            margin-bottom: 20px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        #total{
            font-size: 28px;
            color: #17a2b8;
            font-weight: bold;
        }
    </style>
</head>
<div class="row">
    <div class="col-md-6">
        <h1>📊 Dashboard de Leads</h1>        
    </div>
</div>  

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover mb-4 p-3">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Período</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="date" class="form-control" name="start_date" id="dataInicial" value="{{ request('start_date') ?? date('Y-m-01') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" class="form-control" name="end_date" id="dataFinal" value="{{ request('end_date') ?? date('Y-m-t') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button onclick="loadData()" class="btn btn-info btn-fill w-100">
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</div>

@php 
    $tables = ['leadsContato', 'leadsWhatsapp', 'leadsCustomContato'];
@endphp
@foreach($tables as $table)
    <div class="bg-white shadow-sm sm:rounded-lg mb-5">
        <div class="bg-gray-800 rounded-top p-1">
            <div class="upload-header">
                <div class="title text-white text-lg font-medium ps-2 d-flex align-items-center justify-content-between w-100 pe-2 pt-2">
                    <div>
                        @if($table == 'leadsContato')
                            <i class="fa fa-address-card-o"></i> 
                            Formulário de Contatos
                        @elseif($table == 'leadsWhatsapp')
                            <i class="fa fa-whatsapp"></i> 
                            Formulário de WhatsApp
                        @elseif($table == 'leadsCustomContato')
                            <i class="fa fa-id-badge" aria-hidden="true"></i>
                            Formulário Customizado
                        @endif
                    </div>
                    <div>
                        <small class="text-sm text-gray-300 ps-2"><strong id="total{{ $table }}" style="font-size:2rem;">0</strong> Leads</small> 
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 sm:p-8">
            <div class="grid">
                <div class="card">
                    <div id="{{ $table }}LeadsPorDia"></div>
                </div>

                <div class="card">
                    <div id="{{ $table }}PorLocale"></div>
                </div>

                <div class="card">
                    <div id="{{ $table }}PorFormType"></div>
                </div>
            </div>
        </div>
    </div>
@endforeach


<div class="content mt-3">
    <div class="container-fluid">
        <h2>Enviar relatório por e-mail</h2>
        <form method="POST" action="{{ route('admin.lead.report') }}">
            @csrf
            <div class="mb-3 row">
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="email" placeholder="Digite o e-mail">
                </div>
                <div class="col-sm-2">
                    <a onclick="enviarRelatorio()" class="btn btn-primary">Enviar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
async function loadData() {
    let start = document.getElementById('dataInicial').value;
    let end   = document.getElementById('dataFinal').value;

    let url = `/admin/lead/report?start_date=${start}&end_date=${end}`;


    let res = await fetch(url);
    let data = await res.json();

    // separa os dados
    let contato = data.leadsContato;
    let whatsapp = data.leadsWhatsapp;

    @foreach($tables as $table)
        let {{ $table }} = data.{{ $table }};

        document.getElementById('total{{ $table }}').innerText = {{ $table }}.total;

        gerarGraficoLeadsPorDia({{ $table }}.leadsPorDia, '{{ $table }}LeadsPorDia');
        gerarGraficoLeadsPorLocale({{ $table }}.porLocale, '{{ $table }}PorLocale');
        gerarGraficoLeadsPorFormType({{ $table }}.porFormType, '{{ $table }}PorFormType');

    @endforeach

    // 📈 Leads por dia
   function gerarGraficoLeadsPorDia(dados, containerId) {
        Highcharts.chart(containerId, {
            title: { text: 'Por dia' },
            xAxis: {
                categories: dados.map(i => i.date)
            },
            series: [{
                name: 'Leads',
                data: dados.map(i => parseInt(i.total))
            }]
        });
    }

    function gerarGraficoLeadsPorLocale(dados, containerId) {
        Highcharts.chart(containerId, {
            chart: { type: 'column' },
            title: { text: 'Por região' },
            xAxis: {
                categories: dados.map(i => i.locale ?? 'N/A')
            },
            series: [{
                name: 'Leads',
                data: dados.map(i => parseInt(i.total))
            }]
        });    
    }

    
    function gerarGraficoLeadsPorFormType(dados, containerId) {
        // 📋 Por Form Type
        Highcharts.chart(containerId, {
            chart: { type: 'column' },
            title: { text: 'Formulário' },
            xAxis: {
                categories: dados.map(i => i.form_type ?? 'N/A')
            },
            series: [{
                name: 'Leads',
                data: dados.map(i => parseInt(i.total))
            }]
        });
    }
}

loadData();
</script>

<script>
    async function enviarRelatorio() {
    const email = document.getElementById('email').value;

    if (!email) {
        alert('Digite um email');
        return;
    }

    const charts = Highcharts.charts;
    const svgs = charts
        .filter(chart => chart) // remove nulls
        .map(chart => chart.getSVG());

    let start = document.getElementById('dataInicial').value;
    let end   = document.getElementById('dataFinal').value;

    await fetch('/admin/lead/report/enviar-email', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            _token: document.querySelector('meta[name="csrf-token"]').content,
            email: email,
            svgs: svgs,
            start_date: start,
            end_date: end
        })
    });

    alert('Relatório enviado 🚀');
}
</script>

@endsection