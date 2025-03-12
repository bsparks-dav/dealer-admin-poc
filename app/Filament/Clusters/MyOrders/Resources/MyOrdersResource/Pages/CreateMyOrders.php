<?php

namespace App\Filament\Clusters\MyOrders\Resources\MyOrdersResource\Pages;

use App\Filament\Clusters\MyOrders\Resources\MyOrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyOrders extends CreateRecord
{
    protected static string $resource = MyOrdersResource::class;
}
