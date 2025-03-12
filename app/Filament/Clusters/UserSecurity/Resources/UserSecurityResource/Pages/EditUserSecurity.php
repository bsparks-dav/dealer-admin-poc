<?php

namespace App\Filament\Clusters\UserSecurity\Resources\UserSecurityResource\Pages;

use App\Filament\Clusters\UserSecurity\Resources\UserSecurityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserSecurity extends EditRecord
{
    protected static string $resource = UserSecurityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
