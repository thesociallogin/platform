<?php

namespace App\Traits;

use App\Models\Scopes\TeamScope;
use App\Models\Team;
use Eloquent;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Eloquent
 */
trait BelongsToTeam
{
    public static function bootBelongsToTeam(): void
    {
        static::creating(function ($model) {
            if (blank($model->team_id) && Filament::getTenant()) {
                $model->forceFill([
                    'team_id' => Filament::getTenant()->getKey(),
                ]);
            }
        });

        static::addGlobalScope(new TeamScope);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
