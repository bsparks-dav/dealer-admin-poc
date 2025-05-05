<?php

namespace App\Models;

use App\Services\Soap\ElicustmService\CustomerInquiry;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class SoapCustomer extends Model
{
    use Sushi;

    public $incrementing = false;

    protected $guarded = [];

    public $timestamps = false;

    protected function sushiShouldCache(): bool
    {
        return true;
    }

    public static function getCustomerShipTo(string $email, string $password, string $cust_no): bool|string|array
    {
        $cust_no = session('soap_cust_no');

        $data = session('soap_login');

        try {
            $customerService = app(CustomerInquiry::class);

            $response = $customerService->getCustomerShipTo($data['email'], $data['password'], $cust_no);

            $result = json_decode($response, true);

            if ($result['ReturnCode'] == 0) { // 30001 = no record found.....

                $responseXml = simplexml_load_string($result['ViewCustomerResult']);

                $responseXml->registerXPathNamespace('d', 'urn:schemas-microsoft-com:xml-diffgram-v1');
                $customerData = $responseXml->xpath('//NewDataSet');

                return $customerData;

            } else {
                return [];
            }

        } catch (\SoapFault $e) {
            dd("SOAP Fault: Code: {$e->faultcode}, String: {$e->faultstring}");
        }

    }

}
