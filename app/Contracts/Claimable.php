<?php

namespace App\Contracts;

interface Claimable
{
    /**
     * @return string[]
     */
    public function getClaims(): array;
}
