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
use League\OAuth2\Client\Provider\AbstractProvider;

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
                                        ->live()
                                        ->options(\App\Models\Enums\Provider::class)
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                ]),
                            Forms\Components\Wizard\Step::make('Credentials')
                                ->icon('heroicon-o-key')
                                ->visible(function (Forms\Get $get) {
                                    if ($provider = $get('provider')) {
                                        $provider = \App\Models\Enums\Provider::from($provider);

                                        return is_subclass_of($provider->getProvider(), AbstractProvider::class);
                                    }

                                    return false;
                                })
                                ->schema([
                                    Forms\Components\TextInput::make('client_id')
                                        ->label('Client ID')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('client_secret')
                                        ->label('Client Secret')
                                        ->nullable()
                                        ->maxLength(255),
                                ]),
                            Forms\Components\Wizard\Step::make('Endpoints')
                                ->icon('heroicon-o-link')
                                ->schema([
                                    Forms\Components\TextInput::make('authorization_endpoint')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('token_endpoint')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('userinfo_endpoint')
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
                        Forms\Components\Tabs\Tab::make('OAuth 2.0')
                            ->icon('heroicon-o-key')
                            ->schema([
                                Forms\Components\TextInput::make('client_id')
                                    ->label('Client ID')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('client_secret')
                                    ->password()
                                    ->revealable()
                                    ->label('Client Secret')
                                    ->nullable()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('authorization_endpoint')
                                    ->url()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('token_endpoint')
                                    ->url()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('userinfo_endpoint')
                                    ->maxLength(255),
                                Forms\Components\Repeater::make('scopes')
                                    ->simple(Forms\Components\TextInput::make('scope'))
                                    ->reorderable(false)
                                    ->addActionLabel('Add scope'),
                                Forms\Components\TextInput::make('userinfo_id'),
                                Forms\Components\TextInput::make('userinfo_name'),
                                Forms\Components\TextInput::make('userinfo_email'),
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
                                    ->getStateUsing(fn (Provider $provider) => $provider->getRawOriginal('name'))
                                    ->weight(FontWeight::Bold),
                                Infolists\Components\TextEntry::make('display_name')
                                    ->getStateUsing(fn (Provider $record) => $record->display_name ?? __('No display name provided.'))
                                    ->weight(FontWeight::Bold),
                                Infolists\Components\TextEntry::make('client_id')
                                    ->label('Client ID')
                                    ->copyable(),
                                Infolists\Components\TextEntry::make('client_secret')
                                    ->copyable(),
                                Infolists\Components\TextEntry::make('type')
                                    ->badge(),
                                Infolists\Components\TextEntry::make('provider')
                                    ->badge(),
                            ]),
                        Infolists\Components\Tabs\Tab::make('OAuth 2.0')
                            ->icon('heroicon-o-key')
                            ->schema([
                                Infolists\Components\TextEntry::make('authorization_endpoint')
                                    ->copyable(),
                                Infolists\Components\TextEntry::make('token_endpoint')
                                    ->copyable(),
                                Infolists\Components\TextEntry::make('userinfo_endpoint')
                                    ->copyable(),
                                Infolists\Components\TextEntry::make('redirect_url')
                                    ->label('Redirect URL')
                                    ->copyable(),
                                Infolists\Components\TextEntry::make('scopes')
                                    ->badge()
                                    ->listWithLineBreaks(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateDescription('Create your first provider to start authenticating your users.')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->copyable()
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
                Tables\Filters\SelectFilter::make('type')
                    ->options(ProviderType::class)
                    ->searchable()
                    ->preload()
                    ->multiple(),
                Tables\Filters\SelectFilter::make('provider')
                    ->options(\App\Models\Enums\Provider::class)
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ])
            ->groups(['type', 'provider'])
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
