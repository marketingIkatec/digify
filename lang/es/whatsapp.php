<?php

return [

    'lead_message' => "Hola, acabo de visitar el sitio web de :site_name y me gustaría recibir más información sobre la plataforma.\n\n" .
    "*Datos de contacto:*\n\n" .
    "*Nombre:* :nome\n" .
    "*Correo:* :email\n" .
    "*Celular:* :whatsapp\n" .
    "*Site:* :site\n" .
    (!empty(':segmento') ? ":segmento\n" : "").
    (!empty(':numemployees') ? ":numemployees\n" : "").
    (!empty(':principal_necessidade') ? ":principal_necessidade\n" : "")
];