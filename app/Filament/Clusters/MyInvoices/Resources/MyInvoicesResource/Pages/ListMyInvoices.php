<?php

namespace App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\Pages;

use App\Filament\Clusters\MyInvoices;
use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource;
use App\Models\SoapInvoice;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class ListMyInvoices extends ListRecords
{
    protected static string $resource = MyInvoicesResource::class;

}
