<?php

namespace App\Filament\Clusters\Payments\Resources\PaymentsResource\Pages;

use App\Filament\Clusters\Payments\Resources\PaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePayments extends CreateRecord
{
    protected static string $resource = PaymentsResource::class;
}
