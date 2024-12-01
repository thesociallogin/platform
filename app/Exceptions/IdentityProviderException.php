<?php

namespace App\Exceptions;

use Exception;

class IdentityProviderException extends Exception
{
    protected array $data;

    public static function withData(array $data): static
    {
        return tap(new IdentityProviderException, function (IdentityProviderException $exception) use ($data) {
            $exception->setData($data);
        });
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
