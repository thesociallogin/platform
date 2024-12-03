<?php

namespace App\Filament\Resources\ProviderResource\Pages;

use App\Filament\Resources\ProviderResource;
use App\Models\Enums\ProviderType;
use App\Models\Provider;
use App\Services\ProviderService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProvider extends ViewRecord
{
    protected static string $resource = ProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('test')
                ->label('Test Provider')
                ->color('gray')
                ->visible(fn (Provider $record) => in_array($record->type, [ProviderType::OAUTH, ProviderType::OIDC]))
                ->url(fn (Provider $record) => ProviderService::testProvider($record))
                ->openUrlInNewTab(),
            Actions\EditAction::make(),
        ];
    }
}
