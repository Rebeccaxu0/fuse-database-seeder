<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Start
 *
 * @property int $id
 * @property int $level_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $created_at When user started this level.
 * @property-read \App\Models\Level $level
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\StartFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Start newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Start newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Start query()
 * @method static \Illuminate\Database\Eloquent\Builder|Start whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Start whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Start whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Start whereUserId($value)
 * @mixin \Eloquent
 */
class Start extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = ['level_id', 'user_id'];

    protected $with = ['level', 'user'];

    /**
     * The user that created this start.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the associated level.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}

