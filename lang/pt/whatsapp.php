<?php

return [

    'lead_message' => "Olá, acabei de visitar o site da :site_name e gostaria de mais informações sobre a plataforma.\n\n" .
    "*Dados do contato:*\n\n" .
    "*Nome:* :nome\n" .
    "*E-mail:* :email\n" .
    "*Celular:* :whatsapp\n" .
    (!empty(':name') ? ":name\n" : "").
    (!empty(':numemployees') ? ":numemployees\n" : "")
];