<?php

namespace App\Filament\Clusters\UserSecurity\Resources;

use App\Filament\Clusters\UserSecurity;
use App\Filament\Clusters\UserSecurity\Resources\UserSecurityResource\Pages;
use App\Filament\Clusters\UserSecurity\Resources\UserSecurityResource\RelationManagers;
//use App\Models\UserSecurity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserSecurityResource extends Resource
{
    protected static ?string $model = \App\Models\UserSecurity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = UserSecurity::class;

    protected static ?string $modelLabel = 'User Security';
    //protected static ?string $pluralModelLabel = 'Security Roles';

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
            'index' => Pages\ListUserSecurities::route('/'),
            'create' => Pages\CreateUserSecurity::route('/create'),
            'edit' => Pages\EditUserSecurity::route('/{record}/edit'),
        ];
    }
}
