<?php

namespace App\Data\Connections\Traits;

trait ClaimsTrait
{
    protected array $claims;

    public function getClaims(): array
    {
        return $this->claims;
    }

    public function setClaims(array $claims): void
    {
        $this->claims = $claims;
    }
}
