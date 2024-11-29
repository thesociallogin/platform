<?php

namespace App\Models\Enums;

use App\Providers\Identity\Google;
use App\Providers\Identity\OAuth2;
use Filament\Support\Contracts\HasLabel;

enum Provider: string implements HasLabel
{
    case FACEBOOK = 'facebook';
    case GOOGLE = 'google';
    case OAUTH2 = 'oauth2';

    public function getLabel(): ?string
    {
        return match ($this) {
            Provider::FACEBOOK => 'Facebook',
            Provider::GOOGLE => 'Google',
            Provider::OAUTH2 => 'Custom OAuth 2.0 Provider',
        };
    }

    public function getProvider(): string
    {
        return match ($this) {
            Provider::GOOGLE => Google::class,
            Provider::OAUTH2 => OAuth2::class,
        };
    }
}
