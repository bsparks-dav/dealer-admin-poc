<?php

namespace App\Filament\Clusters\GalleryOfGuns\Resources\GalleryOfGunsResource\Pages;

use App\Filament\Clusters\GalleryOfGuns\Resources\GalleryOfGunsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleryOfGuns extends ListRecords
{
    protected static string $resource = GalleryOfGunsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
