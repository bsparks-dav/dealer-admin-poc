<?php

namespace App\Filament\Clusters\UserSecurity\Resources\UserSecurityResource\Pages;

use App\Filament\Clusters\UserSecurity\Resources\UserSecurityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserSecurity extends CreateRecord
{
    protected static string $resource = UserSecurityResource::class;
}
