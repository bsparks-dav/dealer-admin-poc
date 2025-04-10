<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SOAP Service Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file contains all the default settings required for
    | your SOAP integration(s) throughout your Laravel application.
    |
    */

    'soap_urls' => [

        'production' => env('SOAP_PRODUCTION', 'http://10.1.100.117/eli85service'),

        // 'staging' => env('SOAP_WSDL_STAGING', 'http://10.1.100.100/staging.xml'),

        'local' => env('SOAP_LOCAL', 'http://dws1.davidsonsinc.com/eli85service99'),
    ],

    // add more soap configurations here like timeouts, auth credentials, etc.
];
