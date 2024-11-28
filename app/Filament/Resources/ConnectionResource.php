<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConnectionResource\Pages;
use App\Models\Connection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConnectionResource extends Resource
{
    protected static ?string $model = Connection::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    public static function form(Form $form): Form
    {
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
                                Forms\Components\CheckboxList::make('providers')
                                    ->hintAction(Forms\Components\Actions\Action::make('create')
                                        ->url(ProviderResource::getUrl('create'))
                                    )
                                    ->hintIcon('heroicon-o-plus')
                                    ->helperText('The identity providers that users will be allowed to authenticate with.')
                                    ->relationship('providers', titleAttribute: 'name'),
                                Forms\Components\TextInput::make('redirect_url')
                                    ->label('Redirect URL')
                                    ->helperText('The URL the user will be redirected to after completing authentication. If you installed a client plugin/library, check the settings for the correct URL.')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Toggle::make('private')
                                    ->default(false)
                                    ->helperText('Is this connection used by the public? Set to private if this connection is used for internal purposes only. If private, we will generate one-time private login URLs instead of publicly accessible URLs.'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateDescription('Add your first connection to start using The Social Login.')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
            ])
            ->actions([
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
            'index' => Pages\ListConnections::route('/'),
            'create' => Pages\CreateConnection::route('/create'),
            'edit' => Pages\EditConnection::route('/{record}/edit'),
        ];
    }
}
