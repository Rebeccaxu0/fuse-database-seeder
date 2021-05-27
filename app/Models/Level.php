<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelException extends \Exception { }

class Level extends Model
{
    use HasFactory;

    // Level number (level order) can only be set via the parent Challenge's
    // `reorder_levels()` method.
    protected $guarded = ['level_number'];

    /**
     * Get the associated ChallengeVersion.
     */
    public function challenge()
    {
      return $this->belongsTo(ChallengeVersion::class);
    }

    /**
     * Get the artifacts on this level.
     */
    public function artifacts()
    {
      return $this->morphMany(Artifact::class, 'artifactable');
    }

    public function setChallengeVersionIDAttribute($value) {
      $this->attributes['challenge_version_id'] = $value;
      $this->level_number = NULL;
    }

    public function setLevelNumberAttribute($value) {
      if (!is_null($value)) {
        throw new LevelException('Cannot set the level order number from the level directly. See App\Models\ChallengeVersion::set_levels_order()');
      }
      else {
        $this->attributes['level_number'] = null;
      }
    }
}
