<?php

namespace App\Filament\Clusters\MyLists\Resources\MyFavoritesResource\Pages;

use App\Filament\Clusters\MyLists\Resources\MyFavoritesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyFavorites extends CreateRecord
{
    protected static string $resource = MyFavoritesResource::class;
}
