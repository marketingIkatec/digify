<?php

return [

    'lead_message' => "Hello, I just visited the :site_name website and would like more information about the platform.\n\n" .
    "*Contact details:*\n\n" .
    "*Name:* :nome\n" .
    "*Email:* :email\n" .
    "*Phone:* :whatsapp\n" .
    "*Website:* :site\n" .
    (!empty(':segmento') ? ":segmento\n" : "").
    (!empty(':numemployees') ? ":numemployees\n" : "").
    (!empty(':principal_necessidade') ? ":principal_necessidade\n" : "")
];