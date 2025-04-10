<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Service Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file contains all the default settings required for
    | your SOAP integration(s) throughout your Laravel application.
    |
    */

    'api_urls' => [

        'production' => env('API_PRODUCTION', 'http://10.1.100.117/eli85service'),

        // 'staging' => env('API_STAGING', 'http://10.1.100.100/staging.xml'),

        // 'local' => env('API_LOCAL', 'http://dav-dev-websvc1/elliottapi99'),  // doesn't work in Docker container...
        'local' => env('API_LOCAL', 'http://10.1.100.36/elliottapi99'),
    ],

];
