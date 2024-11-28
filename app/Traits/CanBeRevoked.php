<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin \Eloquent
 */
trait CanBeRevoked
{
    public function scopeRevoked(Builder $builder): void
    {
        $builder->where('revoked', true);
    }

    public function scopeActive(Builder $builder): void
    {
        $builder->where('revoked', false);
    }
}
