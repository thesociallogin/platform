<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string|null $user_id
 * @property string|null $provider_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLink query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLink whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLink whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserLink extends Pivot
{
    protected $table = 'users_links';
}
