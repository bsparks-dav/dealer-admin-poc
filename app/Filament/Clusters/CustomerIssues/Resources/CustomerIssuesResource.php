<?php

namespace App\Filament\Clusters\CustomerIssues\Resources;

use App\Filament\Clusters\CustomerIssues;
use App\Filament\Clusters\CustomerIssues\Resources\CustomerIssuesResource\Pages;
use App\Filament\Clusters\CustomerIssues\Resources\CustomerIssuesResource\RelationManagers;
use App\Models\CustomerIssue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerIssuesResource extends Resource
{
    protected static ?string $model = CustomerIssue::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = CustomerIssues::class;

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
            'index' => Pages\ListCustomerIssues::route('/'),
            'create' => Pages\CreateCustomerIssues::route('/create'),
            'edit' => Pages\EditCustomerIssues::route('/{record}/edit'),
        ];
    }
}
