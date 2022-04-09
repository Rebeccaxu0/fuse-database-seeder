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
    /**
     * Get the previous level.
     */
    public function previous(): ?Level
    {
        return $this->levelable
                    ->levels
                    ->firstWhere('level_number', $this->level_number - 1);
    }

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

    public function next(): ?Level
    {
        return $this->levelable
                    ->levels
                    ->firstWhere('level_number', $this->level_number + 1);
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

    public function isStartable(User $user): bool
    {
        $startable = false;

        // Levels of an Idea belonging to the User are always startable.
        if ($this->levelable::class == Idea::class
            && $this->levelable->team->contains($user)) {
            $startable = true;
        }
        else {
            // Allow level start if user already has a start on this or any
            // later level of this ChallengeVersion (e.g. via a team complete).
            foreach ($this->levelable->levels->reverse() as $level) {
              if ($user->hasStartedLevel($this)) {
                $startable = true;
                break;
              }
              if ($this == $level) {
                break;
              }
            }
            // If parent Challenge is startable...
            if (! $startable && $this->levelable->challenge->isStartable($user)
              // ...and it's the first level...
              && ($this->id == $this->levelable->levels->first()->id
                // ...or the previous level is completed
                    || ($this->previous() && $user->hasCompletedLevel($this->previous()))
                )) {
                $startable = true;
            }
        }

        return $startable;
    }

    public function isStarted(User $user): bool
    {
        return $user->hasStartedLevel($this);
    }

    public function isCompleted(User $user): bool
    {
        return $user->hasCompletedLevel($this);
    }

    public function start(User $user): bool
    {
      if ($this->isStartable($user)) {
        Start::firstOrCreate([
            'level_id' => $this->id,
            'user_id' => $user->id,
        ]);
        return true;
      }
      return false;
    }
}
