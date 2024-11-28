<?php

namespace App\Models\Enums;

use App\Providers\Identity\Google;
use Filament\Support\Contracts\HasLabel;

enum Provider: string implements HasLabel
{
    case FACEBOOK = 'facebook';
    case GOOGLE = 'google';
    case CUSTOM = 'custom';

    public function getLabel(): ?string
    {
        return match ($this) {
            Provider::FACEBOOK => 'Facebook',
            Provider::GOOGLE => 'Google',
            Provider::CUSTOM => 'Custom Provider',
        };
    }

    public function getProvider(): string
    {
        return match ($this) {
            Provider::GOOGLE => Google::class,
        };
    }
}
