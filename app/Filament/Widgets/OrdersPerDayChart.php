<?php

namespace App\Filament\Widgets;

use Filament\Support\Colors\Color;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class OrdersPerDayChart extends ChartWidget
{
    protected static ?string $heading = 'Orders Last Year';

    //protected static string $color = 'info';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '350px';


    protected function getFilters(): ?array
    {
        return [
            'year' => 'Last 12 Months',
            'month' => 'Last 30 Days',
            'week' => 'Last 7 Days',
        ];
    }

    protected function getColors(): array
    {
        return [];
    }

    protected function getLabels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }

    protected function getOptions(): array| null | RawJs
    {
        return [
            'plugins' => [
                'legend' => false,
            ],
//            'scales' => [
//                'x' => [
//                    'ticks' => [
//                        'color' => 'white',
//                    ],
//                ],
//                'y' => [
//                    'ticks' => [
//                        'color' => 'white',
//                    ],
//                ],
//            ],
        ];
    }
//    protected function getOptions(): array
//    {
//        return [
//            'responsive' => true,
//            'maintainAspectRatio' => false,
//            'legend' => [
//                'display' => false,
//            ],
//            'scales' => []
//        ];
//    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Orders Last Year',
                    'data' => [12, 67, 40, 7, 21, 32, 45, 74, 65, 45, 77, 89],
                    //'backgroundColor' => '#800000',
                    //'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
