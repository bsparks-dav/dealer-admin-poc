<?php

namespace App\Services\Soap\InvoiceService;

use App\Services\Soap\SoapService;
use SimpleXMLElement;
use SoapClient;
use SoapFault;

class InvoiceInquiry
{
    protected SoapService $soapService;

    protected SoapClient $client;

    protected ?string $date = null;

    /**
     * @throws SoapFault
     */
    public function __construct()
    {
        $this->soapService = new SoapService('/InvoiceInquiry');

        $wsdl = $this->soapService->getWsdl();

        $options = $this->soapService->getSoapOptions();

        $this->client = new SoapClient($wsdl, $options);
    }

    public function getInvoiceDetail(string $user, string $password, string $invoice_no): bool|string|array
    {
        // hard-coded to get serial numbers...
        // $invoice_no = 'DVX297';
        $params = [
            'UserName' => $user,
            'UserPassword' => $password,
            'invoiceNo' => $invoice_no,
        ];

        try {
            $response = $this->client->GetOneInvoiceDetail($params);

            if (isset($response->GetOneInvoiceDetailResult)) {
                return json_encode($response->GetOneInvoiceDetailResult);
            } else {
                return 'SOAP Response structure does not match';
            }

        } catch (SoapFault $e) {
            return 'SOAP Fault: '.$e->getMessage();
        }
    }

    public function getInvoiceHeaders(string $email, string $password, string $cust_no): bool|string|array
    {
        $params = [
            'UserName' => $email,
            'UserPassword' => $password,
            'customerNo' => $cust_no,
            'invoiceCutoffDate' => date('Y-m-d\TH:i:s', strtotime('2017-12-01')),
            'orderBy' => 'Inv_Date desc',
        ];

        try {
            $response = $this->client->GetInvHdrByCusNo($params);

            if (isset($response->GetInvHdrByCusNoResult)) {
                return json_encode($response->GetInvHdrByCusNoResult);
            } else {
                return 'SOAP Response structure does not match';
            }

        } catch (SoapFault $e) {
            return 'SOAP Fault: '.$e->getMessage();
        }
    }

    public function parseInvoiceDetail(array $invoice): array
    {
        $invoiceArray = [];
        $lineItems = [];

        $invoiceData = $invoice[0];

        $invoiceData = (array) $invoiceData;

        $invoiceData['InvoiceHeader'] = (array) $invoiceData['InvoiceHeader'];

        $headerData = $this->__trimConvert($invoiceData['InvoiceHeader']);

        $invoiceSerials = [];

        if (isset($invoiceData['InvoiceSerialNo'])) {

            $serialType = gettype($invoiceData['InvoiceSerialNo']);

            if ($serialType == 'array') {
                foreach ($invoiceData['InvoiceSerialNo'] as $serialItem) {

                    $invoiceSerials[] = (array) $serialItem;
                }
                $invoiceSerials = $this->__processArray($invoiceSerials);
            }

            if ($serialType == 'object') {

                $invoiceSerials[] = (array) $invoiceData['InvoiceSerialNo'];

                $invoiceSerials = $this->__processArray($invoiceSerials);
            }
        }

        $noteData = $this->__trimConvert((array) $invoiceData['Notes']);

        $headerData['inv_notes'] = $noteData;

        $invoiceArray['HeaderData'] = $headerData;

        $rawItems = [];

        if (isset($invoiceData['InvoiceLineItem'])) {

            // if only one item, it's probably a SimpleXMLObject, not an array. so make it one...
            if (! is_array($invoiceData['InvoiceLineItem'])) {

                $rawItems[] = (array) $invoiceData['InvoiceLineItem'];
            } else {
                // it's still an array of SimpleXmlObjects...
                foreach ($invoiceData['InvoiceLineItem'] as $lineItem) {
                    $rawItems[] = (array) $lineItem;
                }
            }

            foreach ($rawItems as $rawItem) {

                $lineData = $this->__trimConvert($rawItem);

                $lineData['inv_itm_serial_numbers'] = [];

                foreach ($invoiceSerials as $serialNoItem) {

                    if ($serialNoItem['inv_his_ls_item_no'] == $lineData['inv_itm_itm_no']) {

                        $lineData['inv_itm_serial_numbers'][] = $serialNoItem['inv_his_ls_s_l_alt_1'];
                    }
                }

                $lineItems[] = $lineData;
            }

            $invoiceArray['LineItems'] = $lineItems;
        }

        return $invoiceArray;
    }

    public function parseInvHdrResult(array $invoices): array
    {
        $invoicesArray = [];

        foreach ($invoices as $invoice) {

            foreach ($invoice as $item) {

                $itemArray = (array) $item;

                $itemArray['orders'] = $itemArray['orders'] ?? '';

                $invoicesArray[] = array_map(function ($value) {
                    return is_string($value) ? trim($value) : $value;
                }, array_change_key_case($itemArray, CASE_LOWER));
            }
        }

        return $invoicesArray;
    }

    private function __trimConvert(array $element): array
    {
        $data = [];

        foreach ($element as $key => $value) {

            if (is_scalar($value) || is_null($value)) {

                $data[$key] = is_string($value) ? trim($value) : $value;

            } elseif (is_array($value) && empty($value)) {

                $data[$key] = null;

            } elseif (is_object($value)) {

                $data[$key] = trim((string) $value);
            }

            // set keys to lower-case and trim values...
            $data = array_map(function ($value) {
                return is_string($value) ? trim($value) : $value;
            }, array_change_key_case($data, CASE_LOWER));
        }

        return $data;
    }

    private function __processArray(array $inputArray): array
    {
        $result = [];

        foreach ($inputArray as $key => $value) {

            $newKey = strtolower($key);

            if (is_string($value)) {
                $result[$newKey] = trim($value);

            } elseif ($value instanceof SimpleXMLElement) {
                $result[$newKey] = trim((string) $value);

            } elseif (is_array($value)) {
                // recursively process nested arrays...
                $result[$newKey] = $this->__processArray($value);

            } else {
                $result[$newKey] = $value;
            }
        }

        return $result;
    }
}
