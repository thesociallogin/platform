<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditTeamProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Team profile';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->maxLength(255)
                    ->required()
                    ->unique(),
                TextInput::make('email')
                    ->maxLength(255)
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('slug')
                    ->maxLength(255)
                    ->required()
                    ->prefix('https://platform.thesociallogin.com/')
                    ->unique(ignoreRecord: true),
            ]);
    }
}
