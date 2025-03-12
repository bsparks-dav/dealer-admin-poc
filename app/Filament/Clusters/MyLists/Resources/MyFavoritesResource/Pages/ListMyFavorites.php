<?php

namespace App\Filament\Clusters\MyLists\Resources\MyFavoritesResource\Pages;

use App\Filament\Clusters\MyLists\Resources\MyFavoritesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMyFavorites extends ListRecords
{
    protected static string $resource = MyFavoritesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
