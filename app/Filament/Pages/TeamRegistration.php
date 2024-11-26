<?php

namespace App\Filament\Pages;

use App\Models\Team;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class TeamRegistration extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'New team';
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
                    ->unique(),
            ]);
    }

    protected function handleRegistration(array $data): Team
    {
        $team = Team::create($data);
        $team->users()->attach(auth()->user());

        return $team;
    }
}
