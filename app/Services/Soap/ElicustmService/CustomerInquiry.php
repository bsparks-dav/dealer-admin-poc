<?php

namespace App\Services\Soap\ElicustmService;

use App\Services\Soap\SoapService;
use SoapClient;
use SoapFault;

class CustomerInquiry
{
    protected SoapService $soapService;

    protected SoapClient $client;

    protected ?string $date = null;

    /**
     * @throws SoapFault
     */
    public function __construct()
    {
        $this->soapService = new SoapService('/ElicustmService');

        $wsdl = $this->soapService->getWsdl();

        $options = $this->soapService->getSoapOptions();

        $this->client = new SoapClient($wsdl, $options);
    }

    public function getCustomerShipTo(string $email, string $password, string $cust_no): bool|string|array
    {
        $params = [
            'UserName' => $email,
            'UserPassword' => $password,
            'SHIP_TO_CUST_NO' => $cust_no,
        ];

        try {
            $response = $this->client->GetShipTo($params);

            if (isset($response->GetShipToResult)) {
                return json_encode($response->GetShipToResult);
            } else {
                return 'SOAP Response structure does not match';
            }

        } catch (SoapFault $e) {
            return 'SOAP Fault: '.$e->getMessage();
        }
    }

    public function getCustomerData(string $email, string $password, string $cust_no): bool|string|array
    {
        $params = [
            'UserName' => $email,
            'UserPassword' => $password,
            'CUS_NO' => $cust_no,
        ];

        try {
            $response = $this->client->ViewCustomer($params);

            if (isset($response->GetInvHdrByCusNoResult)) {
                return json_encode($response->GetInvHdrByCusNoResult);
            } else {
                return 'SOAP Response structure does not match';
            }

        } catch (SoapFault $e) {
            return 'SOAP Fault: '.$e->getMessage();
        }
    }

    public function parseShipToData(array $inputArray): array
    {
        $result = [];

        foreach ($inputArray as $input) {

            foreach ($input as $item) {

                $itemArray = (array) $item;

                $result[] = array_map(function ($value) {
                    return is_string($value) ? trim($value) : $value;
                }, array_change_key_case($itemArray, CASE_LOWER));
            }
        }

        return $result;
    }

    public function parseSoapResult(array $result): array
    {
        if ($result['ReturnCode'] == 0) { // 30001 = no record found.....

            $responseXml = simplexml_load_string($result['CustomerShipTo']['any']);

            $responseXml->registerXPathNamespace('d', 'urn:schemas-microsoft-com:xml-diffgram-v1');
            $shipToData = $responseXml->xpath('//NewDataSet');

            return $this->parseShipToData($shipToData);

        } else {
            return [];
        }
    }
}
