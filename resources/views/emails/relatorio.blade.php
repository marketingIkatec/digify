@php
    $valorComPercentual = function ($valor, $total) {
        $percentual = $total > 0 ? round(($valor / $total) * 100, 1) : 0;
        return $valor . ' <small style="color:#64748b;font-size:11px;">(' . $percentual . '%)</small>';
    };

    $total = $resumoRelatorio['total'] ?? [
        'total' => $count,
        'campanha' => 0,
        'organico' => 0,
        'corporativo' => 0,
        'gratuito' => 0,
    ];

    $visitas = $resumoRelatorio['visitas'] ?? [
        'total' => 0,
        'campanha' => 0,
        'campanhaPercentual' => 0,
        'organico' => 0,
        'organicoPercentual' => 0,
        'leads' => $total['total'] ?? $count,
        'taxaConversao' => 0,
        'visitasPorLead' => 0,
    ];
@endphp

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @media only screen and (max-width: 640px) {
            .email-container {
                width: 100% !important;
            }

            .metric-column,
            .chart-column {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            .chart-img {
                width: 100% !important;
                max-width: 100% !important;
            }

            .mobile-padding {
                padding: 18px !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f1f5f9;padding:24px 0;">
        <tr>
            <td align="center">
                <table class="email-container" width="760" cellpadding="0" cellspacing="0" border="0"
                    style="width:760px;max-width:760px;background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 12px 30px rgba(15,23,42,.12);">
                    <tr>
                        <td class="mobile-padding" bgcolor="#0f2747"
                            style="background:#0f2747;padding:28px 32px;color:#ffffff;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="left" valign="middle">
                                        <img src="<img src="{{ asset('storage/' . getSettings('logo_header')) }}"
                                            alt="{{ getSettings('site_name_short') }}"
                                            style="height:34px;display:block;margin-bottom:20px;">
                                        <div
                                            style="font-size:13px;color:#7dd3fc;font-weight:700;letter-spacing:.04em;text-transform:uppercase;">
                                            Relatório comercial</div>
                                        <h1
                                            style="margin:6px 0 0 0;font-size:28px;line-height:1.2;font-weight:800;color:#ffffff;">
                                            Relatório de Leads</h1>
                                        <div style="margin-top:8px;font-size:15px;color:#e0f2fe;font-weight:600;">
                                            Período: {{ $start }} até {{ $end }}</div>
                                    </td>
                                    <td align="right" valign="middle" style="white-space:nowrap;">
                                        <div style="font-size:42px;line-height:1;font-weight:800;color:#ffffff;">
                                            {{ $count }}</div>
                                        <div style="font-size:14px;color:#e0f2fe;margin-top:6px;font-weight:600;">leads
                                            no período</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="mobile-padding" style="padding:26px 32px 8px 32px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td class="metric-column" width="25%" style="padding:6px;">
                                        <div
                                            style="border:1px solid #bfdbfe;background:#eff6ff;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#1d4ed8;">
                                                {{ number_format($visitas['total'] ?? 0, 0, ',', '.') }}</div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                Visitas no período</div>
                                        </div>
                                    </td>
                                    <td class="metric-column" width="25%" style="padding:6px;">
                                        <div
                                            style="border:1px solid #c7d2fe;background:#eef2ff;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#4338ca;">
                                                {{ number_format($visitas['leads'] ?? $count, 0, ',', '.') }}</div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                Leads no período</div>
                                        </div>
                                    </td>
                                    <td class="metric-column" width="25%" style="padding:6px;">
                                        <div
                                            style="border:1px solid #bbf7d0;background:#f0fdf4;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#15803d;">
                                                {{ number_format($visitas['taxaConversao'] ?? 0, 2, ',', '.') }}%</div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                Taxa de conversão</div>
                                        </div>
                                    </td>
                                    <td class="metric-column" width="25%" style="padding:6px;">
                                        <div
                                            style="border:1px solid #fed7aa;background:#fff7ed;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#c2410c;">
                                                {{ number_format($visitas['visitasPorLead'] ?? 0, 2, ',', '.') }}</div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                Visitas por lead</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="height:10px;line-height:10px;font-size:10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="metric-column" width="50%" colspan="2" style="padding:6px;">
                                        <div
                                            style="border:1px solid #dbeafe;background:#eff6ff;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#1d4ed8;">
                                                {{ number_format($visitas['campanha'] ?? 0, 0, ',', '.') }}
                                                <small
                                                    style="color:#64748b;font-size:11px;">({{ number_format($visitas['campanhaPercentual'] ?? 0, 1, ',', '.') }}%)</small>
                                            </div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                Visitas por campanha</div>
                                        </div>
                                    </td>
                                    <td class="metric-column" width="50%" colspan="2" style="padding:6px;">
                                        <div
                                            style="border:1px solid #e9d5ff;background:#faf5ff;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#7e22ce;">
                                                {{ number_format($visitas['organico'] ?? 0, 0, ',', '.') }}
                                                <small
                                                    style="color:#64748b;font-size:11px;">({{ number_format($visitas['organicoPercentual'] ?? 0, 1, ',', '.') }}%)</small>
                                            </div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                Visitas orgânicas</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="height:10px;line-height:10px;font-size:10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="metric-column" width="25%" style="padding:6px;">
                                        <div
                                            style="border:1px solid #dbeafe;background:#eff6ff;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#1d4ed8;">
                                                {!! $valorComPercentual($total['campanha'] ?? 0, $total['total'] ?? $count) !!}</div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                Campanha</div>
                                        </div>
                                    </td>
                                    <td class="metric-column" width="25%" style="padding:6px;">
                                        <div
                                            style="border:1px solid #e9d5ff;background:#faf5ff;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#7e22ce;">
                                                {!! $valorComPercentual($total['organico'] ?? 0, $total['total'] ?? $count) !!}</div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                Orgânico</div>
                                        </div>
                                    </td>
                                    <td class="metric-column" width="25%" style="padding:6px;">
                                        <div
                                            style="border:1px solid #bbf7d0;background:#f0fdf4;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#15803d;">
                                                {!! $valorComPercentual($total['corporativo'] ?? 0, $total['total'] ?? $count) !!}</div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                E-mail corporativo</div>
                                        </div>
                                    </td>
                                    <td class="metric-column" width="25%" style="padding:6px;">
                                        <div
                                            style="border:1px solid #fed7aa;background:#fff7ed;border-radius:14px;padding:14px;">
                                            <div style="font-size:24px;font-weight:800;color:#c2410c;">
                                                {!! $valorComPercentual($total['gratuito'] ?? 0, $total['total'] ?? $count) !!}</div>
                                            <div style="font-size:12px;font-weight:700;color:#475569;margin-top:6px;">
                                                E-mail gratuito</div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="mobile-padding" style="padding:18px 32px 8px 32px;">
                            <h2 style="margin:0 0 12px 0;font-size:18px;color:#0f172a;">Resumo por canal</h2>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                style="border-collapse:separate;border-spacing:0;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
                                <tr style="background:#f8fafc;">
                                    <th align="left"
                                        style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;color:#334155;">
                                        Leads</th>
                                    <th align="left"
                                        style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;color:#334155;">
                                        Qtde</th>
                                    <th align="left"
                                        style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;color:#334155;">
                                        Campanha</th>
                                    <th align="left"
                                        style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;color:#334155;">
                                        Orgânico</th>
                                    <th align="left"
                                        style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;color:#334155;">
                                        Corporativo</th>
                                    <th align="left"
                                        style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;color:#334155;">
                                        Gratuito</th>
                                </tr>
                                @foreach ([
        'contato' => 'Leads via Contato',
        'whatsapp' => 'Leads via WhatsApp',
        'custom' => 'Leads Customizados',
        'total' => 'Total',
    ] as $key => $label)
                                    @php
                                        $linha = $resumoRelatorio[$key] ?? [
                                            'total' => 0,
                                            'campanha' => 0,
                                            'organico' => 0,
                                            'corporativo' => 0,
                                            'gratuito' => 0,
                                        ];
                                        $isTotal = $key === 'total';
                                    @endphp
                                    <tr style="background:{{ $isTotal ? '#f8fafc' : '#ffffff' }};">
                                        <td
                                            style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;{{ $isTotal ? 'font-weight:800;' : '' }}">
                                            {{ $label }}</td>
                                        <td
                                            style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;{{ $isTotal ? 'font-weight:800;' : '' }}">
                                            {{ $linha['total'] }}</td>
                                        <td
                                            style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;{{ $isTotal ? 'font-weight:800;' : '' }}">
                                            {!! $valorComPercentual($linha['campanha'], $linha['total']) !!}</td>
                                        <td
                                            style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;{{ $isTotal ? 'font-weight:800;' : '' }}">
                                            {!! $valorComPercentual($linha['organico'], $linha['total']) !!}</td>
                                        <td
                                            style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;{{ $isTotal ? 'font-weight:800;' : '' }}">
                                            {!! $valorComPercentual($linha['corporativo'], $linha['total']) !!}</td>
                                        <td
                                            style="padding:12px;border-bottom:1px solid #e2e8f0;font-size:13px;{{ $isTotal ? 'font-weight:800;' : '' }}">
                                            {!! $valorComPercentual($linha['gratuito'], $linha['total']) !!}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    @if (!empty($images))
                        <tr>
                            <td class="mobile-padding" style="padding:20px 32px 28px 32px;">
                                <h2 style="margin:0 0 12px 0;font-size:18px;color:#0f172a;">Gráficos</h2>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    @foreach (array_chunk($images, 2) as $linha)
                                        <tr>
                                            @foreach ($linha as $img)
                                                <td class="chart-column" width="50%" valign="top"
                                                    style="padding:8px;">
                                                    <img class="chart-img" src="{{ $message->embed($img) }}"
                                                        style="width:100%;max-width:100%;height:auto;display:block;border:1px solid #e2e8f0;border-radius:12px;">
                                                </td>
                                            @endforeach

                                            @for ($i = count($linha); $i < 2; $i++)
                                                <td class="chart-column" width="50%" style="padding:8px;">&nbsp;
                                                </td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <td
                            style="background:#f9fafb; padding:18px; text-align:center; font-size:13px; color:#6b7280;">
                            Relatório gerado automaticamente pelo site<br>
                            <strong>{{ getSettings('site_name_' . app()->getLocale()) }}</strong><br>
                            {{ getSettings('site_url') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
