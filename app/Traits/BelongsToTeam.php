<?php

namespace App\Traits;

use App\Models\Team;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Eloquent
 */
trait BelongsToTeam
{
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
