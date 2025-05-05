<?php

namespace App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\Pages;

use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource;
use Filament\Resources\Pages\ListRecords;

class ListMyInvoices extends ListRecords
{
    protected static string $resource = MyInvoicesResource::class;

}
