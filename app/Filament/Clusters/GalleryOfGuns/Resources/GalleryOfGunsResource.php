<?php

namespace App\Filament\Clusters\GalleryOfGuns\Resources;

use App\Filament\Clusters\GalleryOfGuns;
use App\Filament\Clusters\GalleryOfGuns\Resources\GalleryOfGunsResource\Pages;
use App\Filament\Clusters\GalleryOfGuns\Resources\GalleryOfGunsResource\RelationManagers;
//use App\Models\GalleryOfGuns;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryOfGunsResource extends Resource
{
    protected static ?string $model = \App\Models\GalleryOfGuns::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = GalleryOfGuns::class;


    public static function canCreate(): bool
    {
        return false; // removes the 'Create new' button...
    }

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
            'index' => Pages\ListGalleryOfGuns::route('/'),
            'create' => Pages\CreateGalleryOfGuns::route('/create'),
            'edit' => Pages\EditGalleryOfGuns::route('/{record}/edit'),
        ];
    }
}
