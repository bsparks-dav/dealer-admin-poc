<?php

namespace App\Services\Soap\OrderService;

use App\Services\Soap\SoapService;
use SimpleXMLElement;
use SoapClient;
use SoapFault;

class OrderInquiry
{
    public SoapService $soapService;

    protected SoapClient $client;

    protected ?string $date = null;

    /**
     * @throws SoapFault
     */
    public function __construct()
    {
        $this->soapService = new SoapService('/OrderInquiry');

        $wsdl = $this->soapService->getWsdl();

        $options = $this->soapService->getSoapOptions();

        $this->client = new SoapClient($wsdl, $options);
    }

    public function getOrderDetail(string $order_no): bool|string|array
    {
        $params = [
            'orderNo' => $order_no,
        ];

        try {
            $response = $this->client->GetOneOrderDetail($params);

            if (isset($response->GetOneOrderDetailResult)) {
                return json_encode($response->GetOneOrderDetailResult);
            } else {
                return 'GetOneOrderDetail SOAP Response structure does not match';
            }

        } catch (SoapFault $e) {
            dd('SOAP Error Message: '.$e->getMessage(), $e->getTraceAsString());

        }
    }

    public function getOrders(string $cust_no, string $ship_to_no): bool|string|array
    {
        $params = [
            'numberOfRecords' => 0,
            'customerNo' => $cust_no,
            'startOrderDate' => date('Y-m-d\TH:i:s', strtotime('2018-01-01')),
            'excludePostFlag' => 'N',
            'endOrderDate' => date('Y-m-d\TH:i:s'),
            'shipToNo' => $ship_to_no,
            'type' => 'B',
        ];

        try {
            $response = $this->client->GetOrder($params);

            if (isset($response->GetOrderResult)) {
                return json_encode($response->GetOrderResult);
            } else {
                return 'GetOrder SOAP Response structure does not match';
            }

        } catch (SoapFault $e) {
            dd('SOAP Error Message: '.$e->getMessage(), $e->getTraceAsString());

        }
    }

    public function parseOrderDetail(array $order): array
    {
        $orderArray = [];

        $lineItems = [];

        $orderArray['Notes'] = [];

        $orderData = $order[0] ?? [];

        $orderData = (array) $orderData;

        $orderData['OrderHeader'] = isset($orderData['OrderHeader']) ? (array) $orderData['OrderHeader'] : [];

        $headerData = $this->__trimConvert($orderData['OrderHeader']);

        $orderNotes = [];

        // $lineData['inv_itm_notes'] = [];

        if (isset($orderData['Notes'])) {

            // $headerData['inv_notes'] = $this->__trimConvert((array) $invoiceData['Notes']);
            $noteType = gettype($orderData['Notes']);

            if ($noteType == 'array') {

                foreach ($orderData['Notes'] as $noteItem) {
                    $orderNotes[] = $this->__trimConvert((array) $noteItem);
                }
                $orderNotes = $this->__processArray($orderNotes);
            }

            if ($noteType == 'object') {

                $orderNotes[] = (array) $orderData['Notes'];

                $orderNotes = $this->__processArray($orderNotes);
            }

            $orderArray['Notes'] = $orderNotes;
        }

        $orderArray['HeaderData'] = $headerData;

        $rawItems = [];

        if (isset($orderData['OrderLineItems'])) {

            // if only one item, it's probably a SimpleXMLObject, not an array. so make it one...
            if (! is_array($orderData['OrderLineItems'])) {

                $rawItems[] = (array) $orderData['OrderLineItems'];
            } else {
                // it's still an array of SimpleXmlObjects...
                foreach ($orderData['OrderLineItems'] as $lineItem) {
                    $rawItems[] = (array) $lineItem;
                }
            }

            foreach ($rawItems as $rawItem) {

                $lineData = $this->__trimConvert($rawItem);

                $lineItems[] = $lineData;
            }

            $orderArray['LineItems'] = $lineItems;
        }

        return $orderArray;
    }

    public function parseOrderHdrResult(array $orders): array
    {
        $ordersArray = [];

        foreach ($orders as $order) {

            foreach ($order as $item) {

                $itemType = gettype($item);

                if ($itemType == 'object') {

                    $ordersArray[] = (array) $item;

                    $ordersArray = $this->__processArray($ordersArray);
                }
            }
        }

        return $ordersArray;
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
}
