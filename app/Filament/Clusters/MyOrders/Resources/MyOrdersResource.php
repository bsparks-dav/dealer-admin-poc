<?php

namespace App\Filament\Clusters\MyOrders\Resources;

use App\Enums\PaymentTerm;
use App\Enums\ShipCode;
use App\Filament\Clusters\MyOrders;
use App\Filament\Clusters\MyOrders\Resources\MyOrdersResource\Pages;
use App\Models\SoapOrder;
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
use Illuminate\Support\HtmlString;

class MyOrdersResource extends Resource
{
    protected static ?string $model = SoapOrder::class;

    protected static ?string $modelLabel = 'Orders';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $cluster = MyOrders::class;

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
        return $infolist
            ->columns(1)
            ->schema([
                Tabs::make()
                    ->tabs([
                        Tabs\Tab::make('Order Header')
                            ->columns(2)
                            ->icon('heroicon-o-clipboard')
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
                                                Grid::make(2)
                                                    ->schema([
                                                        TextEntry::make('order_bill_to_name')
                                                            ->color(Color::Teal)
                                                            ->label('Sold To')
                                                            ->formatStateUsing(function ($record) {
                                                                // dd($record);
                                                                return <<<HTML
                                                                    {$record->order_bill_to_name}<br>
                                                                    {$record->order_bill_to_addr_1}<br>
                                                                    {$record->order_bill_to_addr_2}<br>
                                                                    {$record->order_bill_to_city}, {$record->order_bill_to_st} {$record->order_bill_to_zipcd}
                                                                HTML;
                                                            })
                                                            ->html()
                                                            ->columnSpan(1),

                                                        TextEntry::make('order_ship_to_name')
                                                            ->color(Color::Teal)
                                                            ->label('Ship To')
                                                            ->formatStateUsing(function ($record) {
                                                                return <<<HTML
                                                                    {$record->order_ship_to_name}<br>
                                                                    {$record->order_ship_to_addr_1}<br>
                                                                    {$record->order_ship_to_addr_2}<br>
                                                                    {$record->order_ship_to_city}, {$record->order_ship_to_st} {$record->order_ship_to_zipcd}
                                                                HTML;
                                                            })
                                                            ->html()
                                                            ->columnSpan(1),
                                                        TextEntry::make('order_salesman_no_1')
                                                            ->label('Salesperson')
                                                            ->color(Color::Teal),
                                                        TextEntry::make('order_mfging_loc')
                                                            ->label('Location')
                                                            ->color(Color::Teal)
                                                            ->formatStateUsing(function ($state) {
                                                                return ($state == 'P') ? 'Prescott' : 'Greensboro';
                                                            }),
                                                    ]),
                                            ]),
                                        Section::make()
                                            ->columnSpan(1)
                                            ->extraAttributes([
                                                'style' => 'min-height: 17rem;',
                                                'class' => 'flex flex-col',
                                            ])
                                            ->schema([
                                                Grid::make(3)
                                                    ->schema([
                                                        TextEntry::make('order_no')
                                                            ->color(Color::Teal)
                                                            ->label('Order No.'),
                                                        TextEntry::make('order_customer_no')
                                                            ->color(Color::Teal)
                                                            ->label('Customer No.'),
                                                        TextEntry::make('order_date')
                                                            ->color(Color::Teal)
                                                            ->label('Order Date')
                                                            ->formatStateUsing(fn (string $state): string => date('M d, Y', strtotime($state))),
                                                        TextEntry::make('order_ship_via_code')
                                                            ->label('Ship Via')
                                                            ->color(Color::Teal)
                                                            ->formatStateUsing(fn ($state) => ShipCode::formatShipCode('KEY_'.$state) ?? $state),
                                                        TextEntry::make('order_terms_code')
                                                            ->label('Payment Terms')
                                                            ->color(Color::Teal)
                                                            ->formatStateUsing(fn ($state) => PaymentTerm::formatPaymentTerm('KEY_'.$state) ?? $state),
                                                        TextEntry::make('order_purch_order_no')
                                                            ->label('PO No.')
                                                            ->color(Color::Teal),
                                                    ]),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Order Items')
                            ->columns(2)
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make()
                                    ->heading(function () {
                                        return new HtmlString('<div style="color: #40af7f;" class="w-full text-center">Order Items</div>');
                                    })
                                    ->schema(function (Infolist $infolist) {

                                        $details = Pages\ViewMyOrder::getOrderDetails();

                                        $schema[] = Grid::make(6)
                                            // ->extraAttributes(['style' => 'background-color: #236863;'])
                                            ->schema([
                                                TextEntry::make('')
                                                    ->label('Item No.')
                                                    ->weight('bold'),
                                                TextEntry::make('')
                                                    ->state('Description')
                                                    ->weight('bold'),
                                                TextEntry::make('')
                                                    ->label('Qty.')
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

                                                $ext_price = (int) $item['line_itm_qty_ordrd'] * (float) $item['line_itm_unit_price'];

                                                $schema[] = Group::make([
                                                    TextEntry::make('')
                                                        ->state($item['line_itm_item_no']),
                                                    TextEntry::make('')
                                                        ->state($item['line_itm_desc1']),
                                                    TextEntry::make('')
                                                        ->state($item['line_itm_qty_ordrd']),
                                                    TextEntry::make('')
                                                        ->numeric('2')
                                                        ->money('USD')
                                                        ->state($item['line_itm_unit_price']),
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
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Orders')
            ->description('List of all orders from '.date('M d, Y', strtotime('-5 years')))
            ->query(\App\Models\SoapOrder::query())
            ->deferLoading()
            ->extremePaginationLinks()
            ->emptyStateHeading('No Orders found')
            ->defaultSort('order_no', 'desc')
            ->persistFiltersInSession()
            ->columns([
                Tables\Columns\TextColumn::make('order_no')
                    ->label('Order No.')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_date')
                    ->label('Order Date')
                    ->formatStateUsing(fn (string $state): string => date('M d, Y', strtotime($state)))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_amt')
                    ->label('Order Amount')
                    ->state(function ($record) {
                        return $record->order_total_sale_amt + $record->ord_freight_amount + $record->ord_sales_tax_amt_1;
                    })
                    ->money('USD')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_purch_order_no')
                    ->label('PO No.')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_invoice_no')
                    ->label('Status')
                    ->state(function ($record) {

                        return ($record->order_invoice_no == '0') ? 'Pending' : 'Shipping';
                    })
                    ->badge()
                    ->color(function ($state) {
                        return ($state == 'Pending') ? 'warning' : 'success';
                    })
                    ->icon(function ($state) {
                        return ($state == 'Pending') ? 'heroicon-o-clock' : 'heroicon-o-truck';
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_mfging_loc')
                    ->label('Warehouse')
                    ->state(function ($record) {
                        return ($record->order_mfging_loc == 'P') ? 'Arizona' : 'North Carolina';
                    })
                    ->badge()
                    ->icon(function ($record, $state) {
                        return ($record->order_mfging_loc == 'P') ? 'heroicon-o-map' : 'heroicon-o-map-pin';
                    })
                    ->color(function ($record, $state) {
                        return ($record->order_mfging_loc == 'P') ? 'info' : Color::Purple;
                    })
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                // Tables\Filters\SelectFilter::make('order_invoice_no')
                // ->label('Status')
                // ->options(['' => 'All', 0 => 'Pending', 1 => 'Shipping']),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListMyOrders::route('/'),
            // 'create' => Pages\CreateMyOrders::route('/create'),
            // 'edit' => Pages\EditMyOrders::route('/{record}/edit'),
            'view' => Pages\ViewMyOrder::route('/{record}'),
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
