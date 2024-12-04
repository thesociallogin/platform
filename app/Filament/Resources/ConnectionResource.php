<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConnectionResource\Pages;
use App\Filament\Resources\ConnectionResource\RelationManagers\LogsRelationManager;
use App\Models\Connection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConnectionResource extends Resource
{
    protected static ?string $model = Connection::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    public static function form(Form $form): Form
    {
        if ($form->getOperation() === 'create') {
            return $form->schema([
                Forms\Components\Wizard::make()
                    ->columnSpanFull()
                    ->steps([
                        Forms\Components\Wizard\Step::make('Details')
                            ->schema([
                                Forms\Components\Placeholder::make('')
                                    ->content(__('Input some of the connection\'s basic information.')),
                                Forms\Components\TextInput::make('name')
                                    ->helperText('The name of the connection. This should be something easily recognizable such as the name of the app or website you are connecting.')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('description')
                                    ->helperText('An optional description of the connection. This will be displayed in the users main account dashboard.')
                                    ->nullable()
                                    ->maxLength(65535),
                            ]),
                        Forms\Components\Wizard\Step::make('Redirect')
                            ->schema([
                                Forms\Components\Placeholder::make('')
                                    ->content(__('Where will the user be redirected after they successfully complete authentication? If you are using a The Social Login support plugin/integration, the URL will be located in the plugin/integration settings.')),
                                Forms\Components\TextInput::make('redirect_url')
                                    ->url()
                                    ->label('Redirect URL')
                                    ->helperText('The URL the user will be redirected to after completing authentication.')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Wizard\Step::make('Providers')
                            ->schema([
                                Forms\Components\Placeholder::make('')
                                    ->content(__('Choose the identity providers the user will be allowed to sign in to this connection with.')),
                                Forms\Components\CheckboxList::make('providers')
                                    ->hiddenLabel()
                                    ->helperText('The identity providers that users will be allowed to authenticate with.')
                                    ->relationship('providers', titleAttribute: 'name'),
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
                                    ->helperText('The name of the connection. This should be something easily recognizable such as the name of the app or website you are connecting.')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('description')
                                    ->helperText('An optional description of the connection. This will be displayed in the users main account dashboard.')
                                    ->nullable()
                                    ->maxLength(65535),
                                Forms\Components\CheckboxList::make('providers')
                                    ->hintAction(Forms\Components\Actions\Action::make('create')
                                        ->url(ProviderResource::getUrl('create'))
                                    )
                                    ->hintIcon('heroicon-o-plus')
                                    ->helperText('The identity providers that users will be allowed to authenticate with.')
                                    ->relationship('providers', titleAttribute: 'name'),
                                Forms\Components\TextInput::make('redirect_url')
                                    ->url()
                                    ->label('Redirect URL')
                                    ->helperText('The URL the user will be redirected to after completing authentication. If you installed a client plugin/library, check the settings for the correct URL.')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Toggle::make('private')
                                    ->visibleOn('create')
                                    ->default(false)
                                    ->helperText('Is this connection used by the public? Set to private if this connection is used for internal purposes only. If private, we will generate one-time private login URLs instead of publicly accessible URLs.'),
                            ]),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Tabs::make()
                ->columnSpanFull()
                ->tabs([
                    Infolists\Components\Tabs\Tab::make('Details')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Infolists\Components\TextEntry::make('id')
                                ->label('ID')
                                ->copyable(),
                            Infolists\Components\TextEntry::make('secret')
                                ->copyable(),
                            Infolists\Components\TextEntry::make('providers.name')
                                ->badge(),
                            Infolists\Components\TextEntry::make('redirect_url')
                                ->label('Redirect URL')
                                ->copyable(),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateDescription('Add your first connection to start using The Social Login.')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->html()
                    ->wrap()
                    ->limit(),
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
            LogsRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConnections::route('/'),
            'create' => Pages\CreateConnection::route('/create'),
            'edit' => Pages\EditConnection::route('/{record}/edit'),
            'view' => Pages\ViewConnection::route('/{record}'),
        ];
    }
}
