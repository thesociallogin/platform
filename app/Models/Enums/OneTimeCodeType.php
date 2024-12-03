<?php

namespace App\Models\Enums;

enum OneTimeCodeType: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
}
