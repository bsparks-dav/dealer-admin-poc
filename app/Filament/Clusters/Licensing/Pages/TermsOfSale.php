<?php

namespace App\Filament\Clusters\Licensing\Pages;

use App\Filament\Clusters\Licensing;
use Filament\Pages\Page;

class TermsOfSale extends Page
{
    //protected static ?string $navigationLabel = 'Terms And Conditions';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.licensing.pages.terms-of-sale';

    protected static ?string $cluster = Licensing::class;
}
