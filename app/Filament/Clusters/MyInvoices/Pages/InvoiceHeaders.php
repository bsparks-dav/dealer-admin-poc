<?php

namespace App\Filament\Clusters\MyInvoices\Pages;

use App\Filament\Clusters\MyInvoices;
use App\Models\CollectionEloquentModel;
use App\Models\SoapInvoice;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class InvoiceHeaders extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.my-invoices.pages.invoice-headers';

    // if commented out, will not show as cluster link...
    // protected static ?string $cluster = MyInvoices::class;

    // protected static ?string $navigationLabel = 'SOAP Invoices ||';

    // protected static ?string $title = 'Invoice History';

    // protected static ?int $navigationSort = 3;

    // protected static ?string $navigationGroup = 'Customer Data';

    public array $invoice_headers = [];

    public static function shouldRegisterNavigation(): bool
    {
        return false; // this will hide the link from left-side navigation...
    }


    public function mount(): void
    {
        // $this->invoice_headers = SoapInvoice::getSoapInvoices();
    }

    public function table(Table $table): Table
    {
        $model = CollectionEloquentModel::fromCollection(collect($this->invoice_headers));

        return $table
            ->query($model->newQuery())
            ->columns([
                Tables\Columns\TextColumn::make('inv_no')
                    ->label('Invoice #')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inv_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cust_po')
                    ->label('PO Number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_due')
                    ->label('Amount Due')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'PAID' => 'success',
                        'PAST DUE' => 'danger',
                        default => 'warning',
                    }),
            ])
            ->filters([
                // Add filters as needed
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn ($record): string => route('filament.admin.resources.invoices.view', ['record' => $record['inv_no']])),
            ])
            ->bulkActions([
                // Add bulk actions as needed
            ])
            ->emptyStateHeading('No invoices found')
            ->emptyStateDescription('When you have invoices, they will appear here.')
            ->poll('60s'); // Refresh data every 60 seconds
    }

    // If you need to manually refresh the data
    public function refreshData(): void
    {
        $this->invoice_headers = SoapInvoice::getSoapInvoices();
    }
}
