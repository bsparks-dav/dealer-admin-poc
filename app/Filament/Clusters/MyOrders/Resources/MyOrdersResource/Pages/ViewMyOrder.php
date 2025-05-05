<?php

namespace App\Filament\Clusters\MyOrders\Resources\MyOrdersResource\Pages;

use App\Filament\Clusters\MyOrders;
use App\Filament\Clusters\MyOrders\Resources\MyOrdersResource;
use App\Models\SoapOrder;
use App\Services\Soap\OrderService\OrderInquiry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;

class ViewMyOrder extends ViewRecord
{
    protected static string $resource = MyOrdersResource::class;

    // this enables the inner (clustered) link(s)...
    protected static ?string $cluster = MyOrders::class;

    public $orderDetails = null;

    public static array $orderDetails2 = [];

    public function mount($record): void
    {
        parent::mount($record);

        $this->orderDetails = SoapOrder::getOrderDetail();
    }

    public static function getOrderDetails(): array
    {
        $order_no = request()->route('record');

        $orderService = app(OrderInquiry::class);

        $response = $orderService->getOrderDetail($order_no);

        $result = json_decode($response, true);

        if ($result['ReturnCode'] == 0) {

            $responseXml = simplexml_load_string($result['OrderDetail']['any']);

            $responseXml->registerXPathNamespace('d', 'urn:schemas-microsoft-com:xml-diffgram-v1');
            $order = $responseXml->xpath('//NewDataSet');

            return $orderService->parseOrderDetail($order);

        } else {
            return [];
        }
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
