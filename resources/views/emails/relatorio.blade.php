<h1 style="font-family: Arial;">📊 Relatório de Leads {{ $start }} á {{ $end }}</h1>
<h2 style="font-family: Arial;">📊 Qtde Total: <strong>{{ $count }}</strong></h2>

<p>Segue abaixo o resumo:</p>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Leads</th>
        <th>Qtde de Leads</th>
    </tr>

    <tr>
        <td>Leads via Contato</td>
        <td>{{ count($contato) }}</td>
    </tr>

    <tr>
        <td>Leads via WhatsApp</td>
        <td>{{ count($whatsapp) }}</td>
    </tr>
</table>

<br>

@if(!empty($images))
    @foreach($images as $img)
        <p><strong>Gráfico:</strong></p>
        <img src="{{ $message->embed($img) }}" style="width:100%; margin-bottom:20px;">
    @endforeach
@endif