<?php

namespace App\Filament\Clusters\CustomerIssues\Resources\CustomerIssuesResource\Pages;

use App\Filament\Clusters\CustomerIssues\Resources\CustomerIssuesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerIssues extends EditRecord
{
    protected static string $resource = CustomerIssuesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
