<?php

namespace App\Services\Soap;

class SoapService
{
    protected string $service;

    public function __construct(protected ?string $soapService = null)
    {
        $this->service = $soapService;
    }

    public function setService(string $soapService): void
    {
        $this->service = $soapService;
    }

    public function getWsdl(): string
    {
        if (! $this->service) {
            throw new \RuntimeException('SOAP Service name has not been provided.');
        }

        $env = app()->environment();
// hard-coded for testing...
$env = 'production';
        $baseUrl = config('soap.soap_urls.'.($env = ($env === 'production' ? 'production' : 'local')));

        return "{$baseUrl}{$this->service}.asmx?wsdl";
    }

    public function parseXml($element): array
    {
        $responseXml = simplexml_load_string($element);

        $responseXml->registerXPathNamespace('d', 'urn:schemas-microsoft-com:xml-diffgram-v1');

        return $responseXml->xpath('//NewDataSet');
    }

    public function getSoapOptions(): array
    {
        return [
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
    }
}
