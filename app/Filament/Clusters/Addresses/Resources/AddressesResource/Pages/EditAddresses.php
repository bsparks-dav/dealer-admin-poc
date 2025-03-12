<?php

namespace App\Filament\Clusters\Addresses\Resources\AddressesResource\Pages;

use App\Filament\Clusters\Addresses\Resources\AddressesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAddresses extends EditRecord
{
    protected static string $resource = AddressesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
