<?php

namespace App\Traits;

use App\Models\Provider;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Eloquent
 */
trait BelongsToProvider
{
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
