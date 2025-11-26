<?php

return [

    'paths' => ['*'],

    'allowed_methods' => ['GET, POST, PUT,PATCH, OPTIONS'],

    'allowed_origins' => ['http://127.0.0.1:8000', 'http://localhost:5173'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Origin, Content-Type, X-Auth-Token , Cookie'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
