<?php

namespace App\Filament\Widgets;

use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class TotalRevenueStats extends BaseWidget
{
    //protected static ?string $pollingInterval = '10s'; // default is 5 seconds...

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $weekRevenue  = Number::currency(4311, 'USD');
        $monthRevenue = Number::currency(18414, 'USD');
        $totalRevenue = Number::currency(27583, 'USD');

        return [
            Stat::make('Revenue Last 7 Days', $weekRevenue)
                ->color(Color::Lime)
                ->chart([5,4,1,7,1,8,15]),
            Stat::make('Revenue Last 30 Days', $monthRevenue)
                ->color('warning')
                ->chart([1,3,9,2,5,4,2,7,9,3,4,1,3,3,2,5,4]),
            Stat::make('Revenue This Year', $totalRevenue)
                ->color('success')
                // ->icon('heroicon-c-currency-dollar')
                 ->description('7% increase from last year')
                 ->descriptionColor('success')
                 ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([1,3,3,2,5,4,2,7,1,3,5,9,])
        ];
    }
}
