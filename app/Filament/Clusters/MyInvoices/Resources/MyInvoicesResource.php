<?php

namespace App\Filament\Clusters\MyInvoices\Resources;

use App\Enums\StatusCode;
use App\Enums\USState;
use App\Filament\Clusters\MyInvoices;
use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\Pages;
use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\Pages\ViewMyInvoice;
use App\Models\SoapInvoice;
use Filament\Forms\Components\Actions;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;

class MyInvoicesResource extends Resource
{
    protected static ?string $model = SoapInvoice::class;

    protected static ?string $modelLabel = 'Invoices';

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    // this enables the inner (clustered) link(s)...
    protected static ?string $cluster = MyInvoices::class;

    public $to;

    public $from;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1) // controls max width on page...
            ->schema([
                Tabs::make()
                    ->tabs([
                        Tabs\Tab::make('Invoice Header')
                            ->icon('heroicon-o-squares-2x2')
                            ->schema([
                                Section::make()
                                    // ->columns(3)
                                    ->schema([
                                        Group::make()
                                            ->columnSpan(2)
                                            ->columns(2)
                                            ->schema([
                                                TextEntry::make('inv_no')
                                                    ->color(Color::Teal)
                                                    ->label('Invoice #'),
                                                TextEntry::make('inv_bill_to_name')
                                                    ->color(Color::Teal)
                                                    ->label('Customer Name'),
                                                TextEntry::make('inv_bill_to_addr_1')
                                                    ->color(Color::Teal)
                                                    ->label('Address 1'),
                                                TextEntry::make('inv_bill_to_city')
                                                    ->color(Color::Teal)
                                                    ->label('City'),
                                                TextEntry::make('inv_bill_to_zipcd')
                                                    ->color(Color::Teal)
                                                    ->label('Zip Code'),
                                                TextEntry::make('inv_bill_to_st')
                                                    ->color(Color::Teal)
                                                    ->formatStateUsing(fn ($state) => USState::formatStateCode($state) ?? $state)
                                                    ->label('State'),
                                                TextEntry::make('inv_selection_code')
                                                    ->formatStateUsing(fn ($state) => StatusCode::formatStatusCode($state) ?? $state)
                                                    ->label('Status')
                                                    ->size('2xl')
                                                    ->badge() // interferes with the size() method...
                                                    ->icon(function ($state) {
                                                        $enumValue = StatusCode::from($state);

                                                        return $enumValue->getIcon();
                                                    })
                                                    ->iconColor(fn ($state) => StatusCode::getColorForCode($state))
                                                    ->color(fn ($state) => StatusCode::getColorForCode($state)),
                                            ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('Invoice Details')
                            ->icon('heroicon-o-table-cells')
                            ->schema([
                                Section::make('')
                                    ->schema(function (Infolist $infolist) {
                                        $viewMyInvoice = new ViewMyInvoice;
                                        $details = $viewMyInvoice->getInvoiceDetail();
                                        // dd($details);
                                        $schema = [];

                                        $schema[] = Grid::make(6)
                                            ->schema([
                                                TextEntry::make('')
                                                    ->label('Quantity')
                                                    ->weight('bold')
                                                    ->extraAttributes(['class' => 'text-xs text-left uppercase text-gray-500']),
                                                TextEntry::make('')
                                                    ->label('Item No.')
                                                    ->weight('bold'),
                                                TextEntry::make('')
                                                    ->state('Description')
                                                    ->weight('bold'),
                                                TextEntry::make('')
                                                    ->label('Serial Number')
                                                    ->weight('bold')
                                                    ->extraAttributes(['class' => 'text-xs uppercase text-gray-500']),
                                                TextEntry::make('')
                                                    ->state('Unit Price')
                                                    ->weight('bold')
                                                    ->extraAttributes(['class' => 'text-xs uppercase text-gray-500']),
                                                TextEntry::make('')
                                                    ->state('Ext. Price')
                                                    ->weight('bold')
                                                    ->extraAttributes(['class' => 'text-xs uppercase text-gray-500']),
                                            ])
                                            ->extraAttributes(['class' => 'border-b pb-2']);
                                        // dd($details['LineItems']);
                                        if (count($details['LineItems'][0]) != 0) {

                                            foreach ($details['LineItems'] as $index => $item) {

                                                $ext_price = (int) $item['inv_itm_qty_order'] * (float) $item['inv_itm_unit_price'];

                                                $serials = (! empty($item['inv_itm_serial_numbers']) && is_array($item['inv_itm_serial_numbers'])) ?
                                                    implode(',', $item['inv_itm_serial_numbers']) : '';

                                                $serials2 = implode(',', $item['inv_itm_serial_numbers']);

                                                $schema[] = Group::make([
                                                    TextEntry::make('')
                                                        ->state($item['inv_itm_qty_order']),
                                                    TextEntry::make('')
                                                        ->state($item['inv_itm_itm_no']),
                                                    TextEntry::make('')
                                                        ->state($item['inv_itm_desc_1']),

                                                    TextEntry::make('')
                                                        ->color(Color::Teal)
                                                        ->state($serials)
                                                        ->listWithLineBreaks()
                                                        ->separator(',')
                                                        ->limitList(1)
                                                        ->expandableLimitedList(),

                                                    TextEntry::make('')
                                                        ->numeric('2')
                                                        ->money('USD')
                                                        ->state($item['inv_itm_unit_price']),
                                                    TextEntry::make('')
                                                        ->money('USD')
                                                        ->state($ext_price),
                                                ])
                                                    ->columnSpanFull()
                                                    ->columns(6);
                                            }
                                        }

                                        return $schema;
                                    }),

                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\SoapInvoice::query()) // Sushi?...
            ->columns([
                Tables\Columns\TextColumn::make('inv_no')
                    ->label('Invoice No')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inv_purchase_ord_no')
                    ->label('PO #')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inv_order_no')
                    ->label('Order #')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inv_type')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inv_date')
                    ->label('Inv. Date')
                    ->formatStateUsing(fn (string $state): string => date('M d, Y', strtotime($state)))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_amt')
                    ->label('Amount')
                    ->state(function ($record) {
                        return $record->inv_tot_sale_amt +
                            $record->inv_frt_amt +
                            $record->inv_misc_chg_amt +
                            $record->inv_tot_tax_amt;
                    })
                    ->money('USD')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inv_selection_code')
                    ->formatStateUsing(fn ($state) => StatusCode::formatStatusCode($state) ?? $state)
                    ->label('Status')
                    ->badge()
                    ->icon(function ($state) {
                        $enumValue = StatusCode::from($state);

                        return $enumValue->getIcon();
                    })
                    ->iconColor(fn ($state) => StatusCode::getColorForCode($state))
                    ->color(fn ($state) => StatusCode::getColorForCode($state)),
            ])
            ->defaultSort('inv_date', 'desc')
            ->actions([
                // removes the View column from table...
                // Tables\Actions\ViewAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(), // hides the checkboxes next to rows...
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->tooltip('Export all visible records to CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color(Color::hex('#236863'))
                    ->action(function ($livewire) {
                        $records = $livewire->getTableRecords();

                        $filename = 'invoices-export-'.now()->format('YmdHis').'.csv';
                        $tempFilePath = storage_path('app/temp/'.$filename);

                        if (! is_dir(dirname($tempFilePath))) {
                            mkdir(dirname($tempFilePath), 0755, true);
                        }

                        $file = fopen($tempFilePath, 'w');

                        fputcsv($file, [
                            'Invoice No',
                            'PO #',
                            'Order #',
                            'Type',
                            'Inv. Date',
                            'Amount',
                            'Status',
                        ]);

                        foreach ($records as $record) {
                            fputcsv($file, [
                                $record->inv_no,
                                $record->inv_purchase_ord_no,
                                $record->inv_order_no,
                                $record->inv_type,
                                $record->inv_date,
                                $record->total_amt,
                                $record->inv_selection_code,
                            ]);
                        }

                        fclose($file);

                        return response()->download($tempFilePath, $filename)->deleteFileAfterSend();

                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMyInvoices::route('/'),
            // 'create' => Pages\CreateMyInvoices::route('/create'),
            'edit' => Pages\EditMyInvoices::route('/{record}/edit'),
            'view' => Pages\ViewMyInvoice::route('/{record}'),
        ];
    }

    // disable create/edit/delete actions if not applicable...
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record = null): bool
    {
        return false;
    }

    public static function canDelete($record = null): bool
    {
        return false;
    }
}
