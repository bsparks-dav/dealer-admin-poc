<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Revenue extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = 27583;

        return [
            //Stat::make('Revenue This Year',
                //number_format($totalRevenue, 2))
        ];
    }
}
