<?php

namespace App\Models;

use App\Exceptions\LevelException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
Use Spatie\Translatable\HasTranslations;

class Level extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['stuff_you_need'];

    // Level number (level order) can only be set via the parent Challenge's
    // `reorder_levels()` method.
    protected $guarded = ['level_number'];

    /**
     * Get the artifacts on this level.
     */
    public function artifacts()
    {
        return $this->hasMany(Artifact::class);
    }

    /**
     * Get the starts on this level.
     */
    public function starts()
    {
        return $this->hasMany(Start::class);
    }

    /**
     * Get the parent (ChallengeVersion or Idea) of this level.
     */
    public function levelable()
    {
        return $this->morphTo();
    }

    public function next()
    {
        if ($this->levelable::class == ChallengeVersion::class) {
            return $this->levelable
                        ->levels
                        ->firstWhere('level_number', $this->level_number + 1);
        }
    }

    public function setLevelableIdAttribute(int $id)
    {
        $this->attributes['levelable_id'] = $id;
        $this->level_number = null;
    }

    public function setLevelNumberAttribute($value)
    {
        if (! is_null($value)) {
            $e = 'Cannot set the level order number from the level directly. '
                 . 'See App\Models\ChallengeVersion::setLevelsOrder()';
            throw new LevelException($e);
        } else {
            $this->attributes['level_number'] = null;
        }
    }

    public function isStarted(User $user): bool
    {
        return $user->hasStartedLevel($this);
    }
}
