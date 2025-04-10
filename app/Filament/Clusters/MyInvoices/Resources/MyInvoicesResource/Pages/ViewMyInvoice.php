<?php

namespace App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\Pages;

use App\Filament\Clusters\MyInvoices;
use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource;
use App\Models\SoapInvoice;
use App\Services\Soap\InvoiceService\InvoiceInquiry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;

class ViewMyInvoice extends ViewRecord
{
    protected static string $resource = MyInvoicesResource::class;

    // this enables the inner (clustered) link(s)...
    protected static ?string $cluster = MyInvoices::class;

    public $invoiceDetails = null;

    public $invoiceHeader = null;

    public $invoiceItems = null;

    public $headerData = null;

    public static $lineItems = null;

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }


    public function mount($record): void
    {
        parent::mount($record);

        $this->invoiceDetails = SoapInvoice::getInvoiceDetail();
        // dd($this->invoiceDetails);
    }

    public static function getInvoiceDetail(): array|\Illuminate\Support\Collection
    {
        $invoiceId = request()->route('record');

        $data = session('soap_login');

        $invoiceService = app(InvoiceInquiry::class);

        $response = $invoiceService->getInvoiceDetail($data['email'], $data['password'], $invoiceId); // DVE618 DVA119

        $result = json_decode($response, true);

        if ($result['ReturnCode'] == 0) {

            $responseXml = simplexml_load_string($result['InvoiceDetail']['any']);
            $responseXml->registerXPathNamespace('d', 'urn:schemas-microsoft-com:xml-diffgram-v1');
            $invoice = $responseXml->xpath('//NewDataSet');

            return $invoiceService->parseInvoiceDetail($invoice);

        } else {
            return [];
        }
    }

}
