<?php

namespace App\Filament\Resources\StoreProfileResource\Pages;

use App\Filament\Resources\StoreProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStoreProfile extends CreateRecord
{
    protected static string $resource = StoreProfileResource::class;

    // redirects back to List page (index) when Create form data is saved...
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
