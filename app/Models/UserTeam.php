<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property string|null $user_id
 * @property string|null $team_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserTeam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserTeam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserTeam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserTeam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserTeam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserTeam whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserTeam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserTeam whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserTeam extends Pivot
{
    protected $table = 'users_teams';
}
