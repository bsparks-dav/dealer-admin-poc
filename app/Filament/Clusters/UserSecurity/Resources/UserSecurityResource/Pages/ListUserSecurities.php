<?php

namespace App\Filament\Clusters\UserSecurity\Resources\UserSecurityResource\Pages;

use App\Filament\Clusters\UserSecurity\Resources\UserSecurityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserSecurities extends ListRecords
{
    protected static string $resource = UserSecurityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
