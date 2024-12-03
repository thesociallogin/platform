<?php

namespace App\Models;

use App\Models\Enums\OneTimeCodeType;
use App\Traits\BelongsToUser;
use Database\Factories\OneTimeCodeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string|null $user_id
 * @property string $code
 * @property OneTimeCodeType $type
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 *
 * @method static \Database\Factories\OneTimeCodeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OneTimeCode whereUserId($value)
 *
 * @mixin \Eloquent
 */
class OneTimeCode extends Model
{
    /** @use HasFactory<OneTimeCodeFactory> */
    use BelongsToUser, HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'type',
        'expires_at',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(fn (OneTimeCode $model) => $model->forceFill([
            'code' => Str::upper(Str::password(
                length: 6,
                numbers: false,
                symbols: false
            )),
            'expires_at' => now()->addMinutes(10),
        ]));
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'type' => OneTimeCodeType::class,
            'expires_at' => 'datetime',
        ];
    }
}
