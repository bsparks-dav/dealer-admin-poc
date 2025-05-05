<?php

namespace App\Filament\Clusters\MyInvoices\Resources;

use App\Enums\PaymentTerm;
use App\Enums\ShipCode;
use App\Enums\StatusCode;
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
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
// use Illuminate\Database\Query\Builder;
use Illuminate\Support\HtmlString;

class MyInvoicesResource extends Resource
{
    protected static ?string $model = SoapInvoice::class;

    protected static ?string $modelLabel = 'Invoices';

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    // this enables the inner (clustered) link(s)...
    protected static ?string $cluster = MyInvoices::class;

    protected static array $details = [];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        // self::$details = ViewMyInvoice::getInvoiceDetail();

        return $infolist
            ->columns(1) // controls max width on page...
            ->schema([
                Tabs::make()
                    ->tabs([
                        Tabs\Tab::make('Invoice Header')
                            ->columns(2)
                            ->icon('heroicon-o-inbox')
                            ->schema([

                                Grid::make(2)
                                    ->schema([
                                        Section::make()
                                            ->columnSpan(1)
                                            ->extraAttributes([
                                                'style' => 'min-height: 17rem;',
                                                'class' => 'flex flex-col',
                                            ])
                                            ->schema([

                                                // nested Grid here...
                                                Grid::make(2)
                                                    ->schema([

                                                        TextEntry::make('inv_bill_to_name')
                                                            ->color(Color::Teal)
                                                            ->label('Sold To:')
                                                            ->formatStateUsing(function ($record) {
                                                                return <<<HTML
                                                                    {$record->inv_bill_to_name}<br>
                                                                    {$record->inv_bill_to_addr_1}<br>
                                                                    {$record->inv_bill_to_addr_2}<br>
                                                                    {$record->inv_bill_to_city}, {$record->inv_bill_to_st} {$record->inv_bill_to_zipcd}
                                                                HTML;
                                                            })
                                                            ->html()
                                                            ->columnSpan(1),

                                                        TextEntry::make('inv_ship_to_name')
                                                            ->color(Color::Teal)
                                                            ->label('Ship To:')
                                                            ->formatStateUsing(function ($record) {
                                                                return <<<HTML
                                                                    {$record->inv_ship_to_name}<br>
                                                                    {$record->inv_ship_to_addr_1}<br>
                                                                    {$record->inv_ship_to_addr_2}<br>
                                                                    {$record->inv_ship_to_city}, {$record->inv_ship_to_st} {$record->inv_ship_to_zipcd}
                                                                HTML;
                                                            })
                                                            ->html()
                                                            ->columnSpan(1),

                                                        TextEntry::make('inv_selection_code')
                                                            ->label('Status')
                                                            ->badge()
                                                            // ->formatStateUsing(fn ($state) => StatusCode::formatStatusCode($state) ?? $state)
                                                            ->formatStateUsing(function ($record, $state) {
                                                                return StatusCode::formatStatusCode($state);
                                                            })
                                                            ->icon(function ($record, $state) {
                                                                $enumValue = StatusCode::from($state);

                                                                return $enumValue->getIcon();
                                                            })
                                                            ->color(function ($record, $state) {
                                                                return StatusCode::getColorForCode($state);
                                                            }),

                                                        TextEntry::make('inv_ship_via_code')
                                                            ->label('Ship Via')
                                                            ->color(Color::Teal)
                                                            ->formatStateUsing(fn ($state) => ShipCode::formatShipCode('KEY_'.$state) ?? $state),
                                                    ]),

                                            ]),
                                        Section::make()
                                            ->columnSpan(1)
                                            ->extraAttributes([
                                                'style' => 'min-height: 17rem;',
                                                'class' => 'flex flex-col',
                                            ])
                                            ->schema([

                                                Grid::make(2)
                                                    ->schema([

                                                        TextEntry::make('inv_no')
                                                            ->color(Color::Teal)
                                                            ->label('Invoice No.'),

                                                        TextEntry::make('inv_purchase_ord_no')
                                                            ->label('Purchase Order')
                                                            ->color(Color::Teal),

                                                        TextEntry::make('inv_order_no')
                                                            ->label('Order No.')
                                                            ->color(Color::Teal),

                                                        TextEntry::make('inv_order_date')
                                                            ->label('Order Date')
                                                            ->color(Color::Teal)
                                                            ->formatStateUsing(fn (string $state): string => date('M d, Y', strtotime($state))),

                                                        TextEntry::make('inv_customer_no')
                                                            ->color(Color::Teal)
                                                            ->label('Customer No.'),

                                                        TextEntry::make('inv_terms_code')
                                                            ->label('Payment Terms')
                                                            ->color(Color::Teal)
                                                            ->formatStateUsing(fn ($state) => PaymentTerm::formatPaymentTerm('KEY_'.$state) ?? $state),

                                                    ]),

                                            ]),

                                    ]),

                            ]),

                        Tabs\Tab::make('Invoice Items')
                            ->icon('heroicon-o-table-cells')
                            ->schema([
                                Section::make()
                                    ->heading(function () {
                                        return new HtmlString('<div style="color: #40af7f;" class="w-full text-center">Invoice Items</div>');
                                    })
                                    ->schema(function (Infolist $infolist) {

                                        $details = ViewMyInvoice::getInvoiceDetail();

                                        $schema[] = Grid::make(6)
                                            // ->extraAttributes(['style' => 'background-color: #236863;'])
                                            ->schema([
                                                TextEntry::make('')
                                                    ->label('Quantity')
                                                    ->weight('bold'),
                                                TextEntry::make('')
                                                    ->label('Item No.')
                                                    ->weight('bold'),
                                                TextEntry::make('')
                                                    ->state('Description')
                                                    ->weight('bold'),
                                                TextEntry::make('')
                                                    ->label('Serial Number')
                                                    ->weight('bold'),
                                                TextEntry::make('')
                                                    ->state('Unit Price')
                                                    ->weight('bold'),
                                                TextEntry::make('')
                                                    ->state('Ext. Price')
                                                    ->weight('bold'),
                                            ]);
                                        // ->extraAttributes(['class' => 'border-b pb-2'])

                                        if (count($details['LineItems'][0]) != 0) {

                                            foreach ($details['LineItems'] as $index => $item) {

                                                $ext_price = (int) $item['inv_itm_qty_order'] * (float) $item['inv_itm_unit_price'];

                                                $serials = (! empty($item['inv_itm_serial_numbers']) && is_array($item['inv_itm_serial_numbers'])) ?
                                                    implode(',', $item['inv_itm_serial_numbers']) : '';

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
                                                    ->extraAttributes(['style' => 'border-bottom: 1px solid #ccc; padding-bottom: .4rem;'])
                                                    ->columns(6);
                                            }
                                        }

                                        return $schema;
                                    }),

                            ]),

                        Tabs\Tab::make('Tracking')
                            ->hidden(function ($record) {
                                // Hide if ALL relevant fields are empty
                                // return empty($record->inv_itm_notes);
                                return false;
                            })
                            ->icon('heroicon-o-globe-alt')
                            ->schema([

                                Grid::make(2)
                                    ->schema([
                                        Section::make()
                                            ->columnSpan(1)
                                            ->extraAttributes([
                                                'style' => 'min-height: 17rem;',
                                                'class' => 'flex flex-col',
                                            ])
                                            ->schema(function (Infolist $infolist) {

                                                $details = ViewMyInvoice::getInvoiceDetail();

                                                $schema = [];

                                                if (count($details['Notes']) !== 0) {

                                                    $notes = [];

                                                    foreach ($details['Notes'] as $index => $note) {

                                                        $note = explode('   ', $note['note_content_4']);

                                                        $notes[] = $note[2];
                                                    }
                                                    $notes = implode(',', $notes);

                                                    $schema[] = Grid::make(1)
                                                        ->schema([
                                                            TextEntry::make('')
                                                                ->label('Tracking Number(s)')
                                                                ->weight('bold'),

                                                            TextEntry::make('')
                                                                ->color(Color::Teal)
                                                                ->state($notes)
                                                                ->html()
                                                                ->formatStateUsing(function (string $state) {
                                                                    $fedex_url = 'https://www.fedex.com/fedextrack/?trknbr=';

                                                                    return '<a target="_blank" href="'.$fedex_url.$state.'">'.$state.'</a>';
                                                                })
                                                                ->listWithLineBreaks()
                                                                ->limitList(5)
                                                                ->expandableLimitedList()
                                                                ->separator(','),
                                                        ]);
                                                }

                                                return $schema;
                                            }),
                                    ]),
                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Dealer Invoices')
            ->description('List of all invoices from '.date('M d, Y', strtotime('-5 years')))
            ->query(\App\Models\SoapInvoice::query()) // Sushi?...
            ->deferLoading()
            ->extremePaginationLinks()
            ->defaultPaginationPageOption(8)
            ->emptyStateHeading('No Invoices found')
            ->persistFiltersInSession()
            ->filters([
                SelectFilter::make('inv_selection_code')
                    ->label('Status')
                    ->options(function () {
                        $options = [];
                        foreach (StatusCode::cases() as $case) {
                            $options[$case->value] = $case->getLabel();
                        }

                        return $options;
                    })

                    ->query(function ($query, array $data) {
                        if (empty($data['value'])) {
                            return $query;
                        }

                        // For Sushi models, modify this to match how your data is structured
                        return $query->where('inv_selection_code', $data['value']);
                    })

                    ->placeholder('-- Statuses --')
                    ->multiple(),
            ])
            ->filtersTriggerAction(function ($action) {
                return $action->button()->label(' Filter ');
            })
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
                    ->summarize(
                        Summarizer::make()
                            // ->label('Total Amt.')
                            ->using(function ($query) {

                                $records = $query->get();

                                return $records->sum(function ($record) {
                                    return $record->inv_tot_sale_amt +
                                        $record->inv_frt_amt +
                                        $record->inv_misc_chg_amt +
                                        $record->inv_tot_tax_amt;
                                });
                            })
                            ->money('USD')
                    )
                    ->money('USD')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inv_selection_code')
                    ->label('Status')
                    ->badge()
                    // ->formatStateUsing(fn ($state) => StatusCode::formatStatusCode($state) ?? $state)
                    ->formatStateUsing(function ($record, $state) {
                        return StatusCode::formatStatusCode($state);
                    })
                    ->icon(function ($record, $state) {

                        $enumValue = StatusCode::from($state);

                        return $enumValue->getIcon();
                    })
                    // ->color(fn ($state) => StatusCode::getColorForCode($state)),
                    ->color(function ($record, $state) {

                        return StatusCode::getColorForCode($state);
                    }),
                Tables\Columns\TextColumn::make('inv_tot_cost')
                    ->label('Total Cost')
                    ->sortable()
                    ->searchable()
                    ->money('USD')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('inv_tot_weight')
                    ->label('Total Weight')
                    ->sortable()
                    ->searchable()
                    ->state(function ($record) {
                        return $record->inv_tot_weight.' lbs.';
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('inv_selection_code')
                    ->label('Status')
                    ->options(StatusCode::class),
            ])
            ->defaultSort('inv_date', 'desc')
            ->actions([
                // removes the View column from the table...
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
                    ->color(Color::hex('#007bff'))
                    ->action(function ($livewire) {
                        $query = $livewire->getFilteredTableQuery();

                        $records = $query->get();

                        $filename = 'invoices-'.now()->format('YmdHis').'.csv';
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
                                trim($record->inv_no),
                                $record->inv_purchase_ord_no,
                                $record->inv_order_no,
                                $record->inv_type,
                                date('M d, Y', strtotime($record->inv_date)),
                                $record->inv_tot_sale_amt + $record->inv_frt_amt + $record->inv_misc_chg_amt + $record->inv_tot_tax_amt,
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
