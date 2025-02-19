<?php

namespace App\Filament\Resources;

use App\Enums\USState;
use App\Filament\Resources\FflResource\Pages;
use App\Filament\Resources\FflResource\RelationManagers;
use App\Models\Ffl;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;


class FflResource extends Resource
{
    protected static ?string $model = Ffl::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'FFL';
    protected static ?string $pluralModelLabel = 'FFL';

    //protected static ?string $recordTitleAttribute = 'license_name';


    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                TextInput::make('license_no')
                    ->required()
                    ->maxLength(255),
                TextInput::make('license_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('license_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('expire_date')
                    ->required(),
                TextInput::make('business_name')
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
                TextInput::make('state')
                    ->required()
                    ->maxLength(255),
                TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('county')
                    ->required()
                    ->maxLength(255),
                TextInput::make('bus_email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('bus_phone')
                    ->tel()
                    ->maxLength(255),
                TextInput::make('fax')
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('store_hours')
                    ->maxLength(255),
                Textarea::make('directions')
                    ->columnSpanFull(),
                Select::make('dealer_id')
                    ->relationship('dealer', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable(false)
            ->columns([
                TextColumn::make('license_no')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('license_name')
                    ->searchable(),
                //Tables\Columns\TextColumn::make('license_type')
                    //->searchable(),
                TextColumn::make('expire_date')
                    ->date(),
                TextColumn::make('business_name')
                    ->searchable(),
                TextColumn::make('address1')
                    ->searchable(),
                TextColumn::make('address2')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('city')
                    ->searchable(),
                TextColumn::make('state')
                    ->searchable(),
                TextColumn::make('zip_code')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('county')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('bus_email')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('bus_phone')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('fax')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('email')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('store_hours')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('dealer.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                //]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->icon('heroicon-o-document-text')
                    ->iconColor(fn (Ffl $record) => $record->expire_date > Carbon::today() ? 'success' : 'danger')
                    ->heading('Federal Firearms License Information')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('license_no')->label('License No.')
                            ->color(fn (Ffl $record) => $record->expire_date > Carbon::today() ? 'success' : 'danger')
                            ->badge(),
                        TextEntry::make('expire_date')
                            ->label('Expire Date')
                            ->date()
                            ->color(fn (Ffl $record) => $record->expire_date > Carbon::today() ? 'success' : 'danger')
                            ->badge(),
                        TextEntry::make('license_type')
                            ->columnSpanFull()
                            ->label('License Type')
                            ->weight(FontWeight::Bold)
                            ->color('gray'),
                        TextEntry::make('license_name')
                            ->label('License Name')
                            ->weight(FontWeight::Bold)
                            ->color('gray'),
                        TextEntry::make('business_name')
                            ->label('Business Name')
                            ->weight(FontWeight::Bold)
                            ->color('gray'),
                        TextEntry::make('dealer.name')
                            ->label('Dealer Name')
                            ->weight(FontWeight::Bold)
                            ->color('gray'),
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getTableRecordsPerPageSelectOptions(): array
    {
        return []; // Return an empty array to disable pagination options
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFfls::route('/'),
            'create' => Pages\CreateFfl::route('/create'),
            'edit' => Pages\EditFfl::route('/{record}/edit'),
            'view' => Pages\ViewFfl::route('/{record}'),
        ];
    }
}
