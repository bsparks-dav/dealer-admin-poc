<?php

namespace App\Filament\Clusters\MyOrders\Resources\MyOrdersResource\Pages;

use App\Filament\Clusters\MyOrders\Resources\MyOrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyOrders extends EditRecord
{
    protected static string $resource = MyOrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
