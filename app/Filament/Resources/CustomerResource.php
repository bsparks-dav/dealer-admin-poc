<?php

namespace App\Filament\Resources;

use App\Enums\USState;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    //protected static ?string $recordTitleAttribute = 'name';


    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'address1', 'address2', 'city', 'state', 'phone', 'zip_code', 'dealer.name'];
    }

    public static function getNavigationBadge(): ?string
    {
        return Customer::all()->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Section::make()
                    ->heading('Customer Info')
                    ->icon('heroicon-o-user')
                    ->iconColor('info')
                    ->collapsible()
                    ->columns(3)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('address1')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('address2')
                            ->maxLength(255),
                        TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                        Select::make('state')
                            ->enum(USState::class)
                            ->options(USState::class)
                            ->required(),
                        TextInput::make('zip_code')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->tel()
                            ->mask('(999) 999-9999')
                            ->required(),
                        //Forms\Components\Select::make('dealer_id')
                        //->relationship('dealer', 'name'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('address1')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('address2')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('city')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('state')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('zip_code')
                    ->sortable()
                    ->searchable(),
                //TextColumn::make('dealer.name')
                    //->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
            ])
            // this removes the default checkbox column and selectAll in the table...
//            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
//            ])
            ;
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
