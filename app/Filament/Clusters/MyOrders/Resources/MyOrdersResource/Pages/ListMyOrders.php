<?php

namespace App\Filament\Clusters\MyOrders\Resources\MyOrdersResource\Pages;

use App\Filament\Clusters\MyOrders\Resources\MyOrdersResource;
use Filament\Resources\Pages\ListRecords;

class ListMyOrders extends ListRecords
{
    protected static string $resource = MyOrdersResource::class;
}
