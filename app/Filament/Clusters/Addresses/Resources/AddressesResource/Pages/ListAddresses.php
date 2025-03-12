<?php

namespace App\Filament\Clusters\Addresses\Resources\AddressesResource\Pages;

use App\Filament\Clusters\Addresses\Resources\AddressesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAddresses extends ListRecords
{
    protected static string $resource = AddressesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
