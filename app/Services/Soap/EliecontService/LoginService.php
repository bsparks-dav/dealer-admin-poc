<?php

namespace App\Services\Soap\EliecontService;

use SoapClient;
use SoapFault;

class LoginService
{
    protected SoapClient $client;

    protected string $service = '/eliecontservice';

    /**
     * @throws SoapFault
     */
    public function __construct()
    {
        $env = app()->environment();

        if ($env == 'production') {
            $wsdl = config('soap.soap_urls.production').$this->service.'.asmx?wsdl';
        } else {
            $wsdl = config('soap.soap_urls.local').$this->service.'.asmx?wsdl';
        }

        $options = [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => true,
            'exceptions' => true,
            'soap_version' => SOAP_1_2,
            'stream_context' => stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ]),
        ];

        $this->client = new SoapClient($wsdl, $options);
    }

    public function loginRequest(string $email, string $password): bool|string|array
    {
        $params = [
            'UserName' => '',
            'UserPassword' => '',
            'SYCONTCT_ID' => '0',
            'SYCONTCT_EMAIL_ADDR' => $email,
            'IncludeDescFlag' => 'Y',
            'FileView' => 'ARCUSFIL',
            'ExcludeInclude' => '',
            'CheckPassword' => $password,
            'LogType' => '',
            'Source' => $_SERVER['REMOTE_ADDR'],
            'Client' => $_SERVER['SERVER_NAME'],
            'Comment' => '',
        ];

        try {
            $response = $this->client->Login($params);

            if (isset($response->LoginResult)) {
                return json_encode($response->LoginResult);
            } else {
                return 'SOAP Response structure does not match';
            }

        } catch (SoapFault $e) {
            return 'SOAP Fault: '.$e->getMessage();
        }
    }
}
