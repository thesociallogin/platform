<?php

namespace App\Filament\Account\Widgets;

use App\Models\Connection;
use Filament\Widgets\Widget;

class ConnectionWidget extends Widget
{
    public Connection $connection;

    protected static string $view = 'filament.account.widgets.connection-widget';

    public function openConnection(string $connectionId): void
    {
        /** @var Connection $connection */
        $connection = Connection::findOrFail($connectionId);

        $this->redirect($connection->sso_url);
    }
}
