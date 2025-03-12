<?php

namespace App\Filament\Clusters\Payments\Resources\PaymentsResource\Pages;

use App\Filament\Clusters\Payments\Resources\PaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPayments extends EditRecord
{
    protected static string $resource = PaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
