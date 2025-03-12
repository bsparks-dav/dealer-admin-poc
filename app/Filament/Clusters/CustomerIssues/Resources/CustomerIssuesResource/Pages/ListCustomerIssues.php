<?php

namespace App\Filament\Clusters\CustomerIssues\Resources\CustomerIssuesResource\Pages;

use App\Filament\Clusters\CustomerIssues\Resources\CustomerIssuesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerIssues extends ListRecords
{
    protected static string $resource = CustomerIssuesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
