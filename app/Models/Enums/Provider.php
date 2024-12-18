<?php

namespace App\Models\Enums;

use App\Providers\Identity\Google;
use App\Providers\Identity\OAuth2;
use App\Providers\Identity\PasswordlessEmail;
use App\Providers\Identity\PasswordlessSms;
use Filament\Support\Contracts\HasLabel;

enum Provider: string implements HasLabel
{
    case FACEBOOK = 'facebook';
    case GOOGLE = 'google';
    case EMAIL = 'email';
    case SMS = 'sms';
    case OAUTH2 = 'oauth2';
    case OIDC = 'oidc';

    public function getLabel(): ?string
    {
        return match ($this) {
            Provider::FACEBOOK => 'Facebook',
            Provider::GOOGLE => 'Google',
            Provider::EMAIL => 'Passwordless - Email',
            Provider::SMS => 'Passwordless - SMS',
            Provider::OAUTH2 => 'Custom OAuth 2.0 Provider',
            Provider::OIDC => 'Custom OpenID Connect Provider',
        };
    }

    public function getProvider(): string
    {
        return match ($this) {
            Provider::GOOGLE => Google::class,
            Provider::OAUTH2, Provider::OIDC => OAuth2::class,
            Provider::EMAIL => PasswordlessEmail::class,
            Provider::SMS => PasswordlessSms::class,
        };
    }

    public function getType(): ProviderType
    {
        return match ($this) {
            Provider::GOOGLE, Provider::FACEBOOK, Provider::OIDC => ProviderType::OIDC,
            Provider::OAUTH2 => ProviderType::OAUTH,
            Provider::EMAIL, Provider::SMS => ProviderType::PASSWORDLESS,
        };
    }

    public function isPreconfigured(): bool
    {
        return match ($this) {
            Provider::GOOGLE, Provider::FACEBOOK => true,
            default => false
        };
    }
}
