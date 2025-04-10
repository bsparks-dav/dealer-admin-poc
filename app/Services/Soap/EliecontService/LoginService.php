<?php

namespace App\Services\Soap\EliecontService;

use App\Services\Soap\SoapService;
use SoapClient;
use SoapFault;

class LoginService
{
    protected SoapService $soapService;

    protected SoapClient $client;


    /**
     * @throws SoapFault
     */
    public function __construct()
    {
        $this->soapService = new SoapService('/eliecontservice');

        $wsdl = $this->soapService->getWsdl();

        $options = $this->soapService->getSoapOptions();

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
