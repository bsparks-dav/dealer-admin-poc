<?php

namespace App\Filament\Clusters\MyOrders\Resources;

use App\Filament\Clusters\MyOrders;
use App\Filament\Clusters\MyOrders\Resources\MyOrdersResource\Pages;
use App\Filament\Clusters\MyOrders\Resources\MyOrdersResource\RelationManagers;
use App\Models\MyOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MyOrdersResource extends Resource
{
    protected static ?string $model = MyOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = MyOrders::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'create' => Pages\CreateMyOrders::route('/create'),
            'edit' => Pages\EditMyOrders::route('/{record}/edit'),
        ];
    }
}
