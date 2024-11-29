<?php

namespace App\Data\Connections;

use App\Models\ConnectionAuthCode;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AuthCodeTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;
use Spatie\LaravelData\Concerns\EmptyData;
use Spatie\LaravelData\Data;

class AuthCode extends Data implements AuthCodeEntityInterface
{
    use AuthCodeTrait, EmptyData, EntityTrait, TokenEntityTrait;

    public function __construct(
        public ?ConnectionAuthCode $connectionAuthCode = null
    ) {}
}
