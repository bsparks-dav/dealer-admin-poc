<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Revenue7Days extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = 4311;

        return [
            //Stat::make('Revenue Last 7 Days',
                //number_format($totalRevenue, 2))
        ];
    }
}
