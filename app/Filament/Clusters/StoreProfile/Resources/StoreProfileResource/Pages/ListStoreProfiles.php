<?php

namespace App\Filament\Clusters\StoreProfile\Resources\StoreProfileResource\Pages;

use App\Filament\Clusters\StoreProfile\Resources\StoreProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoreProfiles extends ListRecords
{
    protected static string $resource = StoreProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
