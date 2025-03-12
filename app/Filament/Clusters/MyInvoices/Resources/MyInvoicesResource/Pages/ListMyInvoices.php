<?php

namespace App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\Pages;

use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMyInvoices extends ListRecords
{
    protected static string $resource = MyInvoicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
