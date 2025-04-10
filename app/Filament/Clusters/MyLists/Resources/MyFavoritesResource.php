<?php

namespace App\Filament\Clusters\MyLists\Resources;

use App\Filament\Clusters\MyLists;
use App\Filament\Clusters\MyLists\Resources\MyFavoritesResource\Pages;
use App\Filament\Clusters\MyLists\Resources\MyFavoritesResource\RelationManagers;
use App\Models\MyFavorites;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MyFavoritesResource extends Resource
{
    protected static ?string $model = MyFavorites::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = MyLists::class;

    //protected static ?string $tenantOwnershipRelationshipName = 'dealer';

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
            'index' => Pages\ListMyFavorites::route('/'),
            'create' => Pages\CreateMyFavorites::route('/create'),
            'edit' => Pages\EditMyFavorites::route('/{record}/edit'),
        ];
    }
}
