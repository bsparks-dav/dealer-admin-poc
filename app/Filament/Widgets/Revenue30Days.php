<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Revenue30Days extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = 18414;

        return [
            //Stat::make('Revenue Last 30 Days',
                //number_format($totalRevenue, 2))
        ];
    }
}
