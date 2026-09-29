@extends('admin.app')

@section('css_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.leads')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

    <style>
        .lead-dashboard {
            background: #f5f7fb;
            margin: -1.5rem;
            padding: 24px;
            min-height: calc(100vh - 64px);
        }
        .lead-hero {
            background: linear-gradient(135deg, #0f172a, #155e75);
            border-radius: 20px;
            color: #fff;
            padding: 26px;
            margin-bottom: 20px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .16);
        }
        .lead-hero h1 {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
        }
        .lead-hero p {
            color: #cbd5e1;
            margin: 8px 0 0;
        }
        .lead-hero__layout {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .lead-hero__meta {
            text-align: right;
        }
        .lead-panel {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 10px 26px rgba(15, 23, 42, .06);
            margin-bottom: 22px;
            overflow: hidden;
        }
        .lead-panel__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: #111827;
            color: #fff;
            padding: 14px 18px;
        }
        .lead-panel__title {
            font-weight: 800;
            letter-spacing: .01em;
        }
        .lead-panel__total {
            color: #cbd5e1;
            font-size: .86rem;
            white-space: nowrap;
        }
        .lead-panel__total strong {
            color: #fff;
            font-size: 1.4rem;
            margin-right: 4px;
        }
        .lead-panel__body {
            padding: 18px;
        }
        .filter-panel {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 22px;
            box-shadow: 0 8px 22px rgba(15, 23, 42, .05);
        }
        .filter-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 180px;
            gap: 12px;
            align-items: end;
        }
        .filter-grid label {
            font-weight: 800;
            color: #475569;
            font-size: .82rem;
            margin-bottom: 5px;
        }
        .report-actions-row {
            row-gap: 14px;
        }
        .report-actions-label {
            color: #64748b;
            font-weight: 800;
            margin-bottom: 4px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }
        .chart-card {
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            background: #fff;
            padding: 10px;
            min-height: 360px;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .05);
        }
        .chart-card > div {
            min-height: 340px;
        }
        @media (max-width: 991px) {
            .grid,
            .grid-2 {
                grid-template-columns: 1fr;
            }
            .filter-grid {
                grid-template-columns: 1fr;
            }
        }
        #total{
            font-size: 28px;
            color: #17a2b8;
            font-weight: bold;
        }
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }
        .summary-card {
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            background: linear-gradient(180deg, #f8fafc, #fff);
            padding: 18px;
        }
        .summary-card strong {
            display: block;
            font-size: 26px;
            line-height: 1;
            color: #0f2747;
        }
        .summary-card span {
            display: block;
            margin-top: 8px;
            color: #64748b;
            font-weight: 700;
        }
        .summary-card small {
            display: block;
            margin-top: 6px;
            color: #94a3b8;
            line-height: 1.25;
        }
        @media (max-width: 991px) {
            .summary-cards {
                grid-template-columns: 1fr;
            }
            .lead-dashboard {
                margin: -1rem;
                padding: 14px;
            }
            .lead-hero__meta {
                text-align: left;
            }
        }
    </style>
<div class="lead-dashboard">
<div class="lead-hero">
    <div class="lead-hero__layout">
        <div>
            <h1>Dashboard de Leads</h1>
            <p>Visão consolidada de visitas, conversões, origens, campanhas e formulários.</p>
        </div>
        <div class="lead-hero__meta">
            <div style="font-size:13px;color:#bae6fd;font-weight:800;text-transform:uppercase;">Período analisado</div>
            <div id="periodoResumo" style="font-size:18px;font-weight:800;">{{ request('start_date') ?? date('Y-m-01') }} até {{ request('end_date') ?? date('Y-m-t') }}</div>
        </div>
    </div>
</div>

<div class="filter-panel">
    <div class="filter-grid">
        <div>
            <label>Data inicial</label>
            <input type="date" class="form-control" name="start_date" id="dataInicial" value="{{ request('start_date') ?? date('Y-m-01') }}">
        </div>
        <div>
            <label>Data final</label>
            <input type="date" class="form-control" name="end_date" id="dataFinal" value="{{ request('end_date') ?? date('Y-m-t') }}">
        </div>
        <button onclick="loadData()" class="btn btn-info btn-fill w-100">Atualizar dashboard</button>
    </div>
</div>

@php 
    $tables = ['leadsContato', 'leadsWhatsapp', 'leadsCustomContato'];
@endphp

<div class="lead-panel">
    <div class="lead-panel__head">
        <div class="lead-panel__title"><i class="fa fa-bar-chart"></i> Resumo geral</div>
        <div class="lead-panel__total"><strong id="totalGeral">0</strong> leads</div>
    </div>
    <div class="lead-panel__body">
        <div class="summary-cards">
            <div class="summary-card">
                <strong id="totalVisitasGeral">0</strong>
                <span>Visitas no período</span>
            </div>
            <div class="summary-card">
                <strong id="visitasCampanhaGeral">0</strong>
                <span>Visitas por campanha</span>
                <small id="visitasCampanhaPercentualGeral">0% do total de visitas</small>
            </div>
            <div class="summary-card">
                <strong id="visitasOrganicasGeral">0</strong>
                <span>Visitas orgânicas</span>
                <small id="visitasOrganicasPercentualGeral">0% do total de visitas</small>
            </div>
            <div class="summary-card">
                <strong id="totalLeadsGeral">0</strong>
                <span>Leads no período</span>
            </div>
            <div class="summary-card">
                <strong id="taxaConversaoGeral">0%</strong>
                <span>Taxa de conversão</span>
            </div>
            <div class="summary-card">
                <strong id="mediaVisitasPorLead">0</strong>
                <span>Visitas por lead</span>
                <small>Total de visitas únicas dividido pelo total de leads. Quanto menor, melhor.</small>
            </div>
        </div>

        <div class="grid-2">
            <div class="chart-card">
                <div id="geralVisitasLeads"></div>
            </div>

            <div class="chart-card">
                <div id="geralTopPaginasVisitas"></div>
            </div>

            <div class="chart-card">
                <div id="geralPorTipoEmail"></div>
            </div>

            <div class="chart-card">
                <div id="geralPorOrigem"></div>
            </div>

            <div class="chart-card">
                <div id="geralPorUtmSource"></div>
            </div>
        </div>
    </div>
</div>

@foreach($tables as $table)
    <div class="lead-panel">
        <div class="lead-panel__head">
            <div class="lead-panel__title">
                @if($table == 'leadsContato')
                    <i class="fa fa-address-card-o"></i> Formulário de Contatos
                @elseif($table == 'leadsWhatsapp')
                    <i class="fa fa-whatsapp"></i> Formulário de WhatsApp
                @elseif($table == 'leadsCustomContato')
                    <i class="fa fa-id-badge" aria-hidden="true"></i> Formulário Customizado
                @endif
            </div>
            <div class="lead-panel__total"><strong id="total{{ $table }}">0</strong> leads</div>
        </div>
        <div class="lead-panel__body">
            <div class="grid">
                <div class="chart-card">
                    <div id="{{ $table }}LeadsPorDia"></div>
                </div>

                <div class="chart-card">
                    <div id="{{ $table }}PorLocale"></div>
                </div>

                <div class="chart-card">
                    <div id="{{ $table }}PorFormType"></div>
                </div>

                <div class="chart-card">
                    <div id="{{ $table }}PorTipoEmail"></div>
                </div>

                <div class="chart-card">
                    <div id="{{ $table }}PorOrigem"></div>
                </div>
            </div>
        </div>
    </div>
@endforeach


<div class="lead-panel">
    <div class="lead-panel__head">
        <div class="lead-panel__title">Enviar e exportar relatório</div>
    </div>
    <div class="lead-panel__body">
        <form method="POST" action="{{ route('admin.lead.report') }}">
            @csrf
            <div class="row align-items-end report-actions-row">
                <div class="col-md-6">
                    <label class="report-actions-label">Destinatários</label>
                    <input type="text" class="form-control" id="email" placeholder="Digite ou selecione os e-mails">
                    <small class="text-muted">Selecione vários e-mails ou digite separando por ;</small>
                </div>
                <div class="col-md-2">
                    <a onclick="enviarRelatorio()" class="btn btn-primary w-100">Enviar</a>
                </div>
                <div class="col-md-2">
                    <a onclick="baixarExcel()" class="btn btn-success w-100">Baixar Excel</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<script>
async function loadData() {
    let start = document.getElementById('dataInicial').value;
    let end   = document.getElementById('dataFinal').value;
    document.getElementById('periodoResumo').innerText = `${start} até ${end}`;

    let url = `/admin/lead/report?start_date=${start}&end_date=${end}`;


    let res = await fetch(url);
    let data = await res.json();

    document.getElementById('totalGeral').innerText = data.geral.total;
    document.getElementById('totalVisitasGeral').innerText = parseInt(data.geral.totalVisitas).toLocaleString('pt-BR');
    document.getElementById('visitasCampanhaGeral').innerText = parseInt(data.geral.visitasCampanha).toLocaleString('pt-BR');
    document.getElementById('visitasCampanhaPercentualGeral').innerText = `${data.geral.visitasCampanhaPercentual}% do total de visitas`;
    document.getElementById('visitasOrganicasGeral').innerText = parseInt(data.geral.visitasOrganicas).toLocaleString('pt-BR');
    document.getElementById('visitasOrganicasPercentualGeral').innerText = `${data.geral.visitasOrganicasPercentual}% do total de visitas`;
    document.getElementById('totalLeadsGeral').innerText = parseInt(data.geral.total).toLocaleString('pt-BR');
    document.getElementById('taxaConversaoGeral').innerText = `${data.geral.taxaConversao}%`;
    document.getElementById('mediaVisitasPorLead').innerText = data.geral.total > 0 ? (data.geral.totalVisitas / data.geral.total).toFixed(2) : '0';

    gerarGraficoComparativoVisitasLeads(data.geral, 'geralVisitasLeads');
    gerarGraficoTopPaginasVisitas(data.geral.topPaginasVisitas, 'geralTopPaginasVisitas');
    gerarGraficoPizza(data.geral.porTipoEmail, 'geralPorTipoEmail', 'tipo', 'E-mails corporativos x gratuitos');
    gerarGraficoPizza(data.geral.porOrigem, 'geralPorOrigem', 'origem', 'Campanha x orgânico');
    gerarGraficoColuna(data.geral.porUtmSource, 'geralPorUtmSource', 'utm_source', 'Leads por utm_source');

    @foreach($tables as $table)
        let {{ $table }} = data.{{ $table }};

        document.getElementById('total{{ $table }}').innerText = {{ $table }}.total;

        gerarGraficoLeadsPorDia({{ $table }}.leadsPorDia, '{{ $table }}LeadsPorDia');
        gerarGraficoLeadsPorLocale({{ $table }}.porLocale, '{{ $table }}PorLocale');
        gerarGraficoLeadsPorFormType({{ $table }}.porFormType, '{{ $table }}PorFormType');
        gerarGraficoPizza({{ $table }}.porTipoEmail, '{{ $table }}PorTipoEmail', 'tipo', 'E-mails');
        gerarGraficoPizza({{ $table }}.porOrigem, '{{ $table }}PorOrigem', 'origem', 'Origem');

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

    function gerarGraficoColuna(dados, containerId, campo, titulo) {
        Highcharts.chart(containerId, {
            chart: { type: 'column' },
            title: { text: titulo },
            xAxis: {
                categories: dados.map(i => i[campo] ?? 'N/A')
            },
            yAxis: {
                min: 0,
                title: { text: 'Leads' }
            },
            series: [{
                name: 'Leads',
                data: dados.map(i => parseInt(i.total))
            }]
        });
    }

    function gerarGraficoComparativoVisitasLeads(dados, containerId) {
        Highcharts.chart(containerId, {
            chart: { type: 'column' },
            title: { text: 'Visitas x leads' },
            xAxis: {
                categories: ['Visitas', 'Leads']
            },
            yAxis: {
                min: 0,
                title: { text: 'Total' }
            },
            series: [{
                name: 'Total',
                data: [parseInt(dados.totalVisitas), parseInt(dados.total)]
            }]
        });
    }

    function gerarGraficoTopPaginasVisitas(dados, containerId) {
        Highcharts.chart(containerId, {
            chart: { type: 'column' },
            title: { text: 'Top 10 paginas visitadas por origem' },
            xAxis: {
                categories: dados.map(i => i.pagina ?? 'N/A')
            },
            yAxis: {
                min: 0,
                title: { text: 'Visitas' },
                stackLabels: { enabled: true }
            },
            tooltip: { shared: true },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: { enabled: true }
                }
            },
            series: [{
                name: 'Orgânico',
                data: dados.map(i => parseInt(i.organico))
            }, {
                name: 'Campanha',
                data: dados.map(i => parseInt(i.campanha))
            }]
        });
    }

    function gerarGraficoPizza(dados, containerId, campo, titulo) {
        Highcharts.chart(containerId, {
            chart: { type: 'pie' },
            title: { text: titulo },
            tooltip: {
                pointFormat: '<b>{point.y}</b> leads ({point.percentage:.1f}%)'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y}'
                    }
                }
            },
            series: [{
                name: 'Leads',
                colorByPoint: true,
                data: dados.map(i => ({
                    name: i[campo] ?? 'N/A',
                    y: parseInt(i.total)
                }))
            }]
        });
    }
}

loadData();
</script>

<script>
function baixarExcel() {
    let start = document.getElementById('dataInicial').value;
    let end = document.getElementById('dataFinal').value;

    window.location.href = `/admin/lead/report?start_date=${start}&end_date=${end}&download_excel=1`;
}

document.addEventListener('DOMContentLoaded', function () {
    const emailInput = $('#email');

    if (emailInput.length && typeof emailInput.selectize === 'function') {
        emailInput.selectize({
            plugins: ['remove_button'],
            delimiter: ';',
            persist: false,
            create: function (input) {
                const email = input.trim();
                const valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

                if (!valid) {
                    return false;
                }

                return {
                    value: email,
                    text: email
                };
            },
            options: @json(($emailsUsuarios ?? collect())->map(fn($user) => [
                'value' => $user->email,
                'text' => trim(($user->name ? $user->name . ' - ' : '') . $user->email),
            ])->values()),
            valueField: 'value',
            labelField: 'text',
            searchField: ['text', 'value'],
            placeholder: 'Digite ou selecione os e-mails'
        });
    }
});

    async function enviarRelatorio() {
    const email = document.getElementById('email').value;

    if (!email) {
        Swal.fire({
            title: 'Atenção',
            text: 'Digite ou selecione ao menos um email',
            icon: 'warning'
        });
        return;
    }

    const charts = Highcharts.charts;
    const svgs = charts
        .filter(chart => chart) // remove nulls
        .map(chart => chart.getSVG());

    let start = document.getElementById('dataInicial').value;
    let end   = document.getElementById('dataFinal').value;

    Swal.fire({
        title: 'Enviando relatório',
        text: 'Aguarde enquanto geramos o arquivo e enviamos o e-mail.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    try {
        const response = await fetch('/admin/lead/report/enviar-email', {
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

        if (!response.ok) {
            const data = await response.json().catch(() => ({}));
            Swal.fire({
                title: 'Erro ao enviar',
                text: data.message ?? 'Não foi possível enviar o relatório',
                icon: 'error'
            });
            return;
        }

        Swal.fire({
            title: 'Relatório enviado 🚀',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    } catch (error) {
        Swal.fire({
            title: 'Erro ao enviar',
            text: 'Não foi possível enviar o relatório agora.',
            icon: 'error'
        });
    }
}
</script>

@endsection
