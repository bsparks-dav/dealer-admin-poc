<?php

namespace App\Filament\Clusters\MyLists\Resources\MyFavoritesResource\Pages;


use App\Filament\Clusters\MyLists\Resources\MyFavoritesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyFavorites extends EditRecord
{
    protected static string $resource = MyFavoritesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
