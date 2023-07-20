<?php

// config for PalPalani/BayLinks
return [
    'server' => env('BAYLINKS_SERVER'),

    'api' => [
        'url' => 'api/v1',
        'key' => env('BAYLINKS_API_KEY'),
        'secret' => env('BAYLINKS_API_SECRET'),
    ],
];
