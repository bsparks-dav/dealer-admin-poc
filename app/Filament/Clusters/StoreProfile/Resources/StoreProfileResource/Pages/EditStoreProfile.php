<?php

namespace App\Filament\Clusters\StoreProfile\Resources\StoreProfileResource\Pages;

use App\Filament\Clusters\StoreProfile\Resources\StoreProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStoreProfile extends EditRecord
{
    protected static string $resource = StoreProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
