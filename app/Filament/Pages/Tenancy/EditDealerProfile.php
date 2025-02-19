<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\EditTenantProfile;


class EditDealerProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Dealer Profile';
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
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
                TextInput::make('state')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('discount')
                    ->required()
                    ->maxLength(255),
                Textarea::make('terms')
                    ->columnSpanFull(),
                TextInput::make('ship_via')
                    ->maxLength(255),
                TextInput::make('ups_zone')
                    ->maxLength(255),
                TextInput::make('credit_limit')
                    ->maxLength(255),
                TextInput::make('credit_hold_flag')
                    ->maxLength(255),
                TextInput::make('ffl_id')
                    ->numeric(),
            ]);
    }
}
