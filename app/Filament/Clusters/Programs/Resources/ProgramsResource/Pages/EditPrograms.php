<?php

namespace App\Filament\Clusters\Programs\Resources\ProgramsResource\Pages;

use App\Filament\Clusters\Programs\Resources\ProgramsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrograms extends EditRecord
{
    protected static string $resource = ProgramsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
