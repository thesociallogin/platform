<?php

namespace App\Models\Enums;

use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum ProviderType: string implements HasDescription, HasLabel
{
    case OAUTH = 'oauth';
    case OPENID = 'openid';
    case SAML = 'saml';

    public function getLabel(): ?string
    {
        return match ($this) {
            ProviderType::OAUTH => 'OAuth 2.0',
            ProviderType::OPENID => 'OpenID',
            ProviderType::SAML => 'SAML'
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            ProviderType::OAUTH => 'A protocol for secure access to user resources without sharing passwords, commonly used for login with social accounts like Google or Facebook.',
            ProviderType::OPENID => 'An identity layer on top of OAuth 2.0, used for authenticating users and retrieving their profile information securely.',
            ProviderType::SAML => 'An XML-based protocol for exchanging authentication and authorization data between organizations, often used in enterprise single sign-on solutions.'
        };
    }
}
