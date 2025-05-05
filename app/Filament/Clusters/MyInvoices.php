<?php

namespace App\Filament\Clusters;

use App\Enums\USState;
use App\Models\SoapInvoice;
use Filament\Clusters\Cluster;
use Filament\Support\Colors\Color;

class MyInvoices extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected array $casts = [
        'inv_bill_to_st' => USState::class,
    ];

}
