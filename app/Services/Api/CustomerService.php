<?php

namespace App\Services\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class CustomerService
{
    protected string $base_url;

    protected ?string $cust_no = null;

    protected Client $client;

    public function __construct()
    {
        $env = app()->environment();

        if ($env == 'production') {
            $this->base_url = config('api.api_urls.production');
        } else {
            $this->base_url = config('api.api_urls.local');
        }

        $this->client = new Client([
            'base_uri' => $this->base_url,
            'timeout' => 10,
            'headers' => [
                'Accept' => 'text/plain',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getCustomer($cust_no): array
    {
        $queryParams = [
            'CUS_NO' => $cust_no,
            'IncludeAttributes' => true,
            'AttributesWebFlag' => 'string',
            'IncludeNotes' => true,
            'NotesWebFlag' => 'string',
            'IncludeLinks' => true,
            'IncludeContact' => true,
            'IncludeCustomerData' => true,
            'IncludeOpenItems' => true,
        ];

        try {
            $response = $this->client->request('POST', $this->base_url.'/Customer/get', [
                'json' => $queryParams,
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (GuzzleException $e) {
            return [$e->getMessage()];
        }
    }

    public function setCustomerNumber(string $cust_no): void
    {
        $this->cust_no = $cust_no;
    }

    public function getCustomerNumber(): ?string
    {
        return $this->cust_no ?? null;
    }


    public function getTaxCodes(): array
    {
        $obj = new stdClass;

        try {
            $response = $this->client->request('POST', $this->base_url.'/Customer/taxCodes/get', [
                'json' => $obj,
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (GuzzleException $e) {
            return [$e->getMessage()];
        }
    }

    public function getShipViaCodes(): array
    {
        $obj = new stdClass;

        try {
            $response = $this->client->request('POST', $this->base_url.'/Customer/shipViaCodes/get', [
                'json' => $obj,
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (GuzzleException $e) {
            return [$e->getMessage()];
        }
    }

    public function getTermsCodes(): array
    {
        $obj = new stdClass;

        try {
            $response = $this->client->request('POST', $this->base_url.'/Customer/termsCodes/get', [
                'json' => $obj,
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (GuzzleException $e) {
            return [$e->getMessage()];
        }
    }
}
