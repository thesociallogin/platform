<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProviderResource\Pages;
use App\Models\Enums\ProviderType;
use App\Models\Provider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;

class ProviderResource extends Resource
{
    protected static ?string $model = Provider::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        if ($form->getOperation() === 'create') {
            return $form
                ->schema([
                    Forms\Components\Wizard::make()
                        ->columnSpanFull()
                        ->steps([
                            Forms\Components\Wizard\Step::make('Setup')
                                ->icon('heroicon-o-wrench-screwdriver')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('display_name')
                                        ->nullable()
                                        ->maxLength(255),
                                    Forms\Components\Select::make('provider')
                                        ->options(\App\Models\Enums\Provider::class)
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                    Forms\Components\Radio::make('type')
                                        ->options(ProviderType::class)
                                        ->required(),
                                ]),
                            Forms\Components\Wizard\Step::make('Credentials')
                                ->icon('heroicon-o-key')
                                ->schema([
                                    Forms\Components\TextInput::make('client_id')
                                        ->label('Client ID')
                                        ->requiredIf('type', [ProviderType::OAUTH->value, ProviderType::OPENID->value])
                                        ->visible(fn (Forms\Get $get) => 'type', [ProviderType::OAUTH->value, ProviderType::OPENID->value])
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('client_secret')
                                        ->label('Client Secret')
                                        ->nullable()
                                        ->maxLength(255),
                                ]),
                        ]),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Tabs::make()
                    ->columnSpanFull()
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('display_name')
                                    ->nullable()
                                    ->maxLength(255),
                                Forms\Components\Select::make('provider')
                                    ->options(\App\Models\Enums\Provider::class)
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\Radio::make('type')
                                    ->options(ProviderType::class)
                                    ->required(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Credentials')
                            ->icon('heroicon-o-key')
                            ->schema([
                                Forms\Components\TextInput::make('client_id')
                                    ->label('Client ID')
                                    ->requiredIf('type', [ProviderType::OAUTH->value, ProviderType::OPENID->value])
                                    ->visible(fn (Forms\Get $get) => 'type', [ProviderType::OAUTH->value, ProviderType::OPENID->value])
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('client_secret')
                                    ->label('Client Secret')
                                    ->nullable()
                                    ->maxLength(255),
                            ]),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Tabs::make()
                    ->columnSpanFull()
                    ->tabs([
                        Infolists\Components\Tabs\Tab::make('Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Infolists\Components\TextEntry::make('name')
                                    ->weight(FontWeight::Bold),
                                Infolists\Components\TextEntry::make('display_name')
                                    ->getStateUsing(fn (Provider $record) => $record->display_name ?? __('No display name provided.'))
                                    ->weight(FontWeight::Bold),
                                Infolists\Components\TextEntry::make('type')
                                    ->badge(),
                                Infolists\Components\TextEntry::make('provider')
                                    ->badge(),
                            ]),
                        Infolists\Components\Tabs\Tab::make('Authentication')
                            ->icon('heroicon-o-key')
                            ->schema([
                                Infolists\Components\TextEntry::make('login_endpoint'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateDescription('Create your first provider to start authenticating your users.')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('provider')
                    ->badge()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProviders::route('/'),
            'create' => Pages\CreateProvider::route('/create'),
            'edit' => Pages\EditProvider::route('/{record}/edit'),
            'view' => Pages\ViewProvider::route('/{record}'),
        ];
    }
}
