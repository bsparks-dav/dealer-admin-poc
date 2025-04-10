<?php

namespace App\Filament\Clusters\MyInvoices\Pages;

use App\Enums\USState;
use App\Filament\Clusters\MyInvoices;
use App\Models\SoapInvoice;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

class Invoices extends Page
{
    // use InteractsWithForms;
    // use InteractsWithInfolists;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static string $view = 'filament.clusters.my-invoices.pages.soap-invoices';

    protected static ?string $modelLabel = 'Invoices:';

    // protected static string $layout = 'filament-panels::components.layouts.app';

    // protected static ?string $cluster = MyInvoices::class;

    public array $invoice_headers = [];

    protected Collection $filteredData;

    protected ?string $search = null;

    protected array $casts = [
        'inv_bill_to_st' => USState::class,
    ];

    public static function shouldRegisterNavigation(): bool
    {
        return false; // this will hide the link from left-side navigation...
    }

    // If you need to manually refresh the data
    public function refreshData(): void
    {
        $this->invoice_headers = SoapInvoice::getSoapInvoices();
    }
}
