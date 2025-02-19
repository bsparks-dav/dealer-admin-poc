<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DealerResource\Pages;
use App\Models\Dealer;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DealerResource extends Resource
{
    //protected static ?string $model = Dealer::class;
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $tenantRelationshipName = 'blogPosts';


    public static function shouldRegisterNavigation(): bool
    {
        // hides the Dealer link in left-hand sidebar.
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address2')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('discount')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('terms')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('ship_via')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ups_zone')
                    ->maxLength(255),
                Forms\Components\TextInput::make('credit_limit')
                    ->maxLength(255),
                Forms\Components\TextInput::make('credit_hold_flag')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ffl_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('discount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ship_via')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ups_zone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('credit_limit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('credit_hold_flag')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ffl_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListDealers::route('/'),
            'create' => Pages\CreateDealer::route('/create'),
            'edit' => Pages\EditDealer::route('/{record}/edit'),
        ];
    }
}
