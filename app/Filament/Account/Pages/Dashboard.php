<?php

namespace App\Filament\Account\Pages;

use App\Filament\Account\Widgets\ConnectionWidget;
use App\Models\Connection;
use App\Models\Team;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    public function getColumns(): int|string|array
    {
        return 3;
    }

    public function getWidgets(): array
    {
        return Auth::user()->teams->flatMap(function (Team $team) {
            return $team->connections->map(function (Connection $connection) {
                return ConnectionWidget::make([
                    'connection' => $connection,
                ]);
            });
        })->toArray();
    }
}
