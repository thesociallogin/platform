<?php

namespace App\Filament\Resources\ConnectionResource\Pages;

use App\Filament\Resources\ConnectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ViewConnection extends ViewRecord
{
    protected static string $resource = ConnectionResource::class;

    public function getHeading(): string|Htmlable
    {
        return $this->record->name ?? parent::getHeading();
    }

    public function getSubheading(): string|Htmlable|null
    {
        return new HtmlString($this->record->description ?? parent::getSubheading());
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
