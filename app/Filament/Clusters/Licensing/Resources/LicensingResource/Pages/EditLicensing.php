<?php

namespace App\Filament\Clusters\Licensing\Resources\LicensingResource\Pages;

use App\Filament\Clusters\Licensing\Resources\LicensingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLicensing extends EditRecord
{
    protected static string $resource = LicensingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
