<?php

namespace App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\Pages;

use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyInvoices extends EditRecord
{
    protected static string $resource = MyInvoicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
