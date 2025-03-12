<?php

namespace App\Filament\Clusters\Addresses\Resources\AddressesResource\Pages;

use App\Filament\Clusters\Addresses\Resources\AddressesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAddresses extends CreateRecord
{
    protected static string $resource = AddressesResource::class;
}
