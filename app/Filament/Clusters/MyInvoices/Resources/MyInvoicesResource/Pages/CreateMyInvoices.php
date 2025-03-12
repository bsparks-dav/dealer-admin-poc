<?php

namespace App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\Pages;

use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyInvoices extends CreateRecord
{
    protected static string $resource = MyInvoicesResource::class;
}
