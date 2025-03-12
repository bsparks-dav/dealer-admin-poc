<?php

namespace App\Filament\Clusters\Licensing\Resources;

use App\Filament\Clusters\Licensing;
use App\Filament\Clusters\Licensing\Resources\LicensingResource\Pages;
use App\Filament\Clusters\Licensing\Resources\LicensingResource\RelationManagers;
use Filament\Forms\Form;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LicensingResource extends Resource
{
    protected static ?string $model = \App\Models\Licensing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Licensing';
    protected static ?string $pluralModelLabel = 'Licenses';

    protected static ?string $cluster = Licensing::class;


    public static function canCreate(): bool
    {
        return false; // removes the 'Create new' button...
    }

//    public function panel(Panel $panel): Panel
//    {
//        return $panel
//            ->pages([
//                SettingsPage::class,
//                // other pages...
//            ])
//            ->resources([
//                PostResource::class,
//                // other resources...
//            ]);
//    }

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
                //Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListLicensings::route('/'),
            //'create' => Pages\CreateLicensing::route('/create'),
            //'edit' => Pages\EditLicensing::route('/{record}/edit'),
            //'view' => Pages\ViewLicensing::route('/{record}'),
        ];
    }
}
