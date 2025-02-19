<?php

namespace App\Filament\Resources\FflResource\Pages;

use App\Filament\Resources\FflResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFfls extends ListRecords
{
    protected static string $resource = FflResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
