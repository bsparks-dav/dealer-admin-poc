<?php

namespace App\Filament\Resources\FflResource\Pages;

use App\Filament\Resources\FflResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFfl extends EditRecord
{
    protected static string $resource = FflResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
