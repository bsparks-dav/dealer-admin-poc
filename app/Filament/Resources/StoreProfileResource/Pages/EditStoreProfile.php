<?php

namespace App\Filament\Resources\StoreProfileResource\Pages;

use App\Filament\Resources\StoreProfileResource;
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

    // redirects back to List page (index) when Edit form data is updated...
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
