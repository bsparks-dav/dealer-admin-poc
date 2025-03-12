<?php

namespace App\Filament\Clusters\MyLists\Pages;

use App\Filament\Clusters\MyLists;
use Filament\Pages\Page;

class MyWants extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.my-lists.pages.my-wants';

    protected static ?string $cluster = MyLists::class;
}
