<?php

namespace App\Filament\Resources;

use App\Enums\USState;
use App\Filament\Resources\StoreProfileResource\Pages;
use App\Filament\Resources\StoreProfileResource\RelationManagers;
use App\Models\StoreProfile;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreProfileResource extends Resource
{
    protected static ?string $model = StoreProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $modelLabel = 'Store Profile';
    protected static ?string $pluralModelLabel = 'Store Profile';

    protected static ?string $recordTitleAttribute = 'store_name';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->heading('Store Information')
                    ->icon('heroicon-o-building-storefront')
                    ->iconColor('info')
                    ->columns(3)
                    ->collapsible()
                    ->schema([
                        TextInput::make('store_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slogan')
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
                            ->options(USState::class)
                            ->required(),
                        TextInput::make('zip_code')
                            ->required()
                            ->mask('99999')
                            ->maxLength(10),
                        TextInput::make('phone')
                            ->tel()
                            ->mask('(999) 999-9999')
                            ->required(),
                        TextInput::make('fax')
                            ->tel()
                            ->mask('(999) 999-9999'),
                    ]),
                Section::make()
                    ->heading('Additional Information')
                    ->icon('heroicon-o-ellipsis-horizontal-circle')
                    ->iconColor('info')
                    ->collapsible()
                    ->columns(3)
                    ->schema([
                        TextInput::make('email')
                            ->email()
                            ->prefixIcon('heroicon-o-envelope')
                            ->prefixIconColor('primary')
                            ->maxLength(255),
                        TextInput::make('website')
                            ->prefixIcon('heroicon-o-globe-alt')
                            ->prefixIconColor('primary')
                            ->maxLength(255),
                        TextInput::make('store_hours')
                            ->maxLength(255),
                        Textarea::make('directions')
                            ->columnSpanFull(),
                        Textarea::make('about')
                            ->columnSpanFull()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->columns([
                TextColumn::make('store_name')
                    ->label('Store Name'),
                TextColumn::make('slogan'),
                TextColumn::make('address1')
                    ->visibleFrom('lg'),
                TextColumn::make('address2')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('city')
                    ->visibleFrom('lg'),
                TextColumn::make('state')
                    ->visibleFrom('lg'),
                TextColumn::make('zip_code')
                    ->visibleFrom('lg')
                    ->label('Zip Code'),
                TextColumn::make('phone')
                    ->visibleFrom('lg'),
                TextColumn::make('fax')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('website')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('store_hours')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('View'),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
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
            'index' => Pages\ListStoreProfiles::route('/'),
            'create' => Pages\CreateStoreProfile::route('/create'),
            'edit' => Pages\EditStoreProfile::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false; // Prevents the resource from appearing in the sidebar
    }
}
