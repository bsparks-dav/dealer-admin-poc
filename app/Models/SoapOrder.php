<?php

namespace App\Models;

use App\Services\Soap\OrderService\OrderInquiry;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class SoapOrder extends Model
{
    use Sushi;

    public $incrementing = false;

    protected $guarded = [];

    public $timestamps = false;

    protected $primaryKey = 'order_no';

    // without this, it was erroring constantly. trying to get the table row count for 'soap_orders'...
    protected array $schema = [
        'order_no' => 'string',
        'order_date' => 'datetime',
        'order_amt' => 'float',
        'order_invoice_no' => 'string',
        'order_mfging_loc' => 'string',
        'order_purch_order_no' => 'string',
    ];

    protected function sushiShouldCache(): bool
    {
        return true;
    }

    public function getRows(): array|\Illuminate\Support\Collection
    {
        return static::getSoapOrders();
    }

    // Override the count method to prevent SQL queries
    //    public function count(): int
    //    {
    //        return $this->getRows()->count();
    //    }

    public static function getOrderDetail(): array|\Illuminate\Support\Collection
    {
        $order_no = request()->route('record');

        $orderService = app(OrderInquiry::class);

        $response = $orderService->getOrderDetail($order_no);

        $result = json_decode($response, true);

        if ($result['ReturnCode'] == 0) {

            $soapService = $orderService->soapService;

            $order = $soapService->parseXml($result['OrderDetail']['any']);

            return $orderService->parseOrderDetail($order);

        } else {
            return [];
        }
    }

    public static function getSoapOrders(): array|\Illuminate\Support\Collection
    {
        $cust_no = session('soap_cust_no');

        $ship_to_no = session('ship_to_no');

        // hard-coded for testing...
        // $cust_no = '036021';
        // $cust_no = '399825';
        // $cust_no = '698883';
        $cust_no = '566666';
        // $cust_no = '859368';
        // $cust_no = '0354870001';

        try {
            $orderService = app(OrderInquiry::class);

            $response = $orderService->getOrders($cust_no, $ship_to_no);

            $result = json_decode($response, true);

            if ($result['ReturnCode'] == 0) { // 30001 = no record found.....

                $soapService = $orderService->soapService;

                $orders = $soapService->parseXml($result['OrderHeaders']['any']);

                return $orderService->parseOrderHdrResult($orders);

            } else {
                return [];
            }

        } catch (\SoapFault $e) {
            dd("SOAP Fault: Code: {$e->faultcode}, String: {$e->faultstring}");
        }

    }
}
