<?php

return [
    'name' => 'Epayco',
    'apiKey' => env('PUBLIC_KEY'),
    'privateKey' => env('PRIVATE_KEY'),
    'lenguage' => env('EPAYCO_LANGUAGE', 'ES'),
    'test' => env('PAYU_ON_TESTING', true),
];
