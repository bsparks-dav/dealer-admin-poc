<?php

namespace App\Filament\Clusters\MyInvoices\Resources;

use App\Filament\Clusters\MyInvoices;
use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\Pages;
use App\Filament\Clusters\MyInvoices\Resources\MyInvoicesResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MyInvoicesResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = MyInvoices::class;

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
            'index' => Pages\ListMyInvoices::route('/'),
            'create' => Pages\CreateMyInvoices::route('/create'),
            'edit' => Pages\EditMyInvoices::route('/{record}/edit'),
        ];
    }
}
