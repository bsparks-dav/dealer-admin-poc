<?php

namespace App\Filament\Clusters\CustomerIssues\Resources\CustomerIssuesResource\Pages;

use App\Filament\Clusters\CustomerIssues\Resources\CustomerIssuesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerIssues extends CreateRecord
{
    protected static string $resource = CustomerIssuesResource::class;
}
