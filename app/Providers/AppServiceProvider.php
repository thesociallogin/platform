<?php

namespace App\Providers;

use App\Models\PassportClient;
use App\Models\PassportToken;
use Filament\Forms\Components\Field;
use Filament\Infolists\Components\Entry;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Passport::ignoreRoutes();
    }

    public function boot(): void
    {
        URL::forceHttps();

        Entry::configureUsing(function (Entry $entry) {
            $entry->label(function ($component) {
                return Str::of($component->getName())
                    ->before('.')
                    ->title()
                    ->replace(['-', '_'], ' ')
                    ->ucfirst();
            });
        });

        Field::configureUsing(function (Field $field) {
            $field->label(function ($component) {
                return Str::of($component->getName())
                    ->before('.')
                    ->title()
                    ->replace(['-', '_'], ' ')
                    ->ucfirst();
            });
        });

        Passport::useClientModel(PassportClient::class);
        Passport::useTokenModel(PassportToken::class);
    }
}
