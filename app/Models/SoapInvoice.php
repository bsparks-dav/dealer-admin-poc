<?php

namespace App\Models;

use App\Services\Soap\InvoiceService\InvoiceInquiry;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class SoapInvoice extends Model
{
    use Sushi;

    public $incrementing = false;

    protected $guarded = [];

    public $timestamps = false;

    protected $primaryKey = 'inv_no';

    // without this, it was erroring constantly. trying to get the table row count for 'soap_invoices'...
    protected array $schema = [
        'inv_no' => 'string',
        'inv_date' => 'datetime',
        'inv_amt' => 'float',
        'inv_invoice_no' => 'string',
        'inv_mfging_loc' => 'string',
        'inv_purch_order_no' => 'string',
    ];

    public function getRows(): array|\Illuminate\Support\Collection
    {
        return static::getSoapInvoices();
    }

    // Override the count method to prevent SQL queries
    public function count(): int
    {
        return $this->getRows()->count();
    }

    protected function sushiShouldCache(): bool
    {
        return true;
    }

    public static function getInvoiceDetail(): array|\Illuminate\Support\Collection
    {
        $data = session('soap_login');

        $inv_id = request()->route('record');

        $invoiceService = app(InvoiceInquiry::class);

        $response = $invoiceService->getInvoiceDetail($data['email'], $data['password'], $inv_id);

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

    public static function getSoapInvoices(): array|\Illuminate\Support\Collection
    {
        $data = session('soap_login');

        $cust_no = session('soap_cust_no');

        // hard-coded for testing...
        // $cust_no = '036021'; // good one...
        // $cust_no = '399825';
        // $cust_no = '698883'; // over 53k rows...
        // $cust_no = '566666'; // over 60k rows...
        $cust_no = '859368';
        // $cust_no = '036021';

        $invoiceService = app(InvoiceInquiry::class);

        try {
            $response = $invoiceService->getInvoiceHeaders($data['email'], $data['password'], $cust_no);
            $result = json_decode($response, true);

            if ($result['ReturnCode'] == 0) { // 30001 = no record found...

                $responseXml = simplexml_load_string($result['InvoiceHeaders']['any']);

                $responseXml->registerXPathNamespace('d', 'urn:schemas-microsoft-com:xml-diffgram-v1');
                $invoices = $responseXml->xpath('//NewDataSet');

                return $invoiceService->parseInvHdrResult($invoices);

            } else {
                return [];
            }

        } catch (\SoapFault $e) {
            dd("SOAP Fault: Code: {$e->faultcode}, String: {$e->faultstring}");
        }
    }
}
