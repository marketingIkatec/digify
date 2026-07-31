<!DOCTYPE html>

<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Equipe de Suporte</title>
</head>
<body style="margin:0; padding:0; background:#f4f6f8; font-family: Arial, Helvetica, sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8; padding:40px 0;">
    <tr>
      <td align="center">
        <!-- CARD -->
        <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

          <!-- HEADER COM LOGO -->
          <tr>
            <td style="background:#0D489B; background:linear-gradient(135deg, #0069FB, #0D489B); padding:24px; text-align:center;">
              
              <!-- LOGO -->
              <img 
                src="{{ asset('build/images/site/digify-byikatec-w.png') }}" 
                alt="Logo"
                style="max-width:160px; margin-bottom:16px; filter: brightness(0) invert(1);"
              >

              <div style="display: flex; flex-direction: row; align-content: center; justify-content: center;">
                📩 
                <h1 style="color:#ffffff; margin:0; font-size:20px; font-weight:600;margin-left: 5px;">Equipe de Suporte</h1>
              </div>

            </td>
          </tr>

          <!-- CONTENT -->
          <tr>
            <td style="padding:30px; color:#1f2937; font-size:15px; line-height:1.6;">

              <p style="margin-top:0;">
                Você recebeu uma nova mensagem através do site.
              </p>

              <table width="100%" cellpadding="0" cellspacing="0" style="margin:20px 0;">
                <tr>
                  <td style="padding:8px 0; width:150px;"><strong>👤 Nome:</strong></td>
                  <td style="padding:8px 0;">{{ $lead['nome'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td style="padding:8px 0;"><strong>✉️ E-mail:</strong></td>
                  <td style="padding:8px 0;">{{ $lead['email'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td style="padding:8px 0;"><strong>🖥️ URL da Digify:</strong></td>
                  <td style="padding:8px 0;">{{ $lead['url'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td style="padding:8px 0;"><strong>📞 WhatsApp:</strong></td>
                  <td style="padding:8px 0;">{{ $lead['whatsapp'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td style="padding:8px 0;"><strong>🖥️ Mensagem:</strong></td>
                  <td style="padding:8px 0;">{{ $lead['mensagem'] ?? '-' }}</td>
                </tr>
                
              </table>
            </td>
          </tr>

          <!-- FOOTER -->
          <tr>
            <td style="background:#f9fafb; padding:18px; text-align:center; font-size:13px; color:#6b7280;">
              Enviado automaticamente pelo site<br>
              <strong>{{ getSettings('site_name') }}</strong><br>
              {{ getSettings('site_url') }}
            </td>
          </tr>

        </table>
        <!-- END CARD -->

      </td>
    </tr>
  </table>

</body>
</html>
