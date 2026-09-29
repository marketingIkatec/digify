<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso administrativo</title>
</head>

<body style="margin:0; padding:0; background:#f4f6f8; font-family: Arial, Helvetica, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="max-width:600px; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">
                    <tr>
                        <td
                            style="background:#0D489B; background:linear-gradient(135deg, #0069FB, #0D489B); padding:24px; text-align:center;">
                            <img src="{{ asset('storage/' . getSettings('logo_header')) }}" alt="Logo"
                                style="max-width:160px; margin-bottom:16px; filter: brightness(0) invert(1);">
                            <h1 style="color:#ffffff; margin:0; font-size:20px; font-weight:600;">Acesso administrativo
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px; color:#1f2937; font-size:15px; line-height:1.6;">
                            <p style="margin-top:0;">Olá, {{ $name }}.</p>
                            <p>Seu acesso administrativo foi criado/atualizado. Use os dados abaixo para entrar:</p>

                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin:20px 0; background:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:16px;">
                                <tr>
                                    <td style="padding:8px 0; width:120px;"><strong>E-mail:</strong></td>
                                    <td style="padding:8px 0;">{{ $email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;"><strong>Senha:</strong></td>
                                    <td style="padding:8px 0;"><strong
                                            style="font-size:18px; color:#0D489B;">{{ $password }}</strong></td>
                                </tr>
                            </table>

                            @if ($loginUrl)
                                <p style="text-align:center; margin:28px 0;">
                                    <a href="{{ $loginUrl }}"
                                        style="display:inline-block; background:#0069FB; color:#fff; text-decoration:none; padding:12px 22px; border-radius:8px; font-weight:600;">Acessar
                                        painel</a>
                                </p>
                            @endif

                            <p style="color:#6b7280; font-size:13px;">Por segurança, recomendamos alterar a senha após o
                                primeiro acesso.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f9fafb; padding:18px; text-align:center; font-size:13px; color:#6b7280;">
                            Enviado automaticamente<br>
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
