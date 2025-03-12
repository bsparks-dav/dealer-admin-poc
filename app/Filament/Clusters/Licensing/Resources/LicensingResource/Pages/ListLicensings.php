<?php

namespace App\Filament\Clusters\Licensing\Resources\LicensingResource\Pages;

use App\Filament\Clusters\Licensing\Resources\LicensingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLicensings extends ListRecords
{
    protected static string $resource = LicensingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
