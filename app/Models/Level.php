<?php

namespace App\Models;

use App\Exceptions\LevelException;
use App\Models\ChallengeVersion;
use App\Models\Idea;
use App\Models\Start;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Log;
use Plank\Mediable\Mediable;

class Level extends Model
{
    use HasFactory;
    use HasTranslations;
    use Mediable;
    use SoftDeletes;

    public $translatable = [
        'blurb',
        'challenge_desc',
        'stuff_you_need_desc',
        'get_started_desc',
        'how_to_complete_desc',
        'get_help_desc',
        'power_up_desc',
        'facilitator_notes_desc',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blurb',
        'challenge_desc',
        'get_help_desc',
        'get_started_desc',
        'how_to_complete_desc',
        'level_number',
        'levelable_id',
        'levelable_type',
        'power_up_desc',
        'prerequisite_level',
        'stuff_you_need_desc',
    ];

    // Level number (level order) can only be set via the parent Challenge's
    // `reorder_levels()` method... or by default when level is created.
    protected $guarded = ['level_number'];

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
     * Associated preview image (File).
     */
    public function preview_image()
    {
        return $this->hasOne(File::class);
    }

    /**
     * Get the artifacts on this level.
     */
    public function artifacts()
    {
        return $this->hasMany(Artifact::class);
    }

    // /**
    //  * The help articles linked to this level.
    //  */
    // public function help_articles()
    // {
    //     return $this->belongsToMany(HelpArticle::class)
    //         ->withPivot(['order']);
    // }

    /**
     * Get the starts on this level.
     */
    public function starts()
    {
        return $this->hasMany(Start::class);
    }

    /**
     * Get the users currently on this level.
     */
    public function currentUsers()
    {
        return $this->hasMany(User::class, 'current_level');
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


    /**
     * The most recent artifact for a given user.
     */
    public function mostRecentArtifact(User $user) : ?Artifact
    {
        return $user->artifacts()
                    ->where('level_id', $this->id)
                    ->get()
                    ->sort()
                    ->last();
    }

    /**
     * The most recent start for a given user.
     * Really there should only even be one, but things happen. Let's just
     * always only return one and it's the latest.
     */
    public function mostRecentStart(User $user) : ?Start
    {
        return $user->starts
                    ->where('level_id', '=', $this->id)
                    ->sort()
                    ->last();
    }

    public function setLevelNumberAttribute($value)
    {
        if (! is_null($value)) {
            if ($this->attributes['levelable_type'] == ChallengeVersion::class) {
                $parent = ChallengeVersion::find($this->attributes['levelable_id']);
            }
            else {
                $parent = Idea::find($this->attributes['levelable_id']);
            }
            if (in_array($value, $parent->levels->pluck('level_number')->all())) {
                $e = 'That level_number already exists. Cannot set.'
                    . 'See App\Models\ChallengeVersion::setLevelsOrder()';
                throw new LevelException($e);
            }
            else {
                $this->attributes['level_number'] = $value;
            }
        } else {
            $this->attributes['level_number'] = null;
        }
    }

    public function isStartable(User $user): bool
    {
        // return Cache::remember("u{$user->id}_can_start_level_{$this->id}", 1800, function () use ($user) {
            // If there's no parent ChallengeVersion or Idea (missing or soft-deleted), return false.
            if (! $this->levelable) {
                return false;
            }
            // Levels of an Idea belonging to the User are always startable.
            if ($user->isAdmin() || $user->isFacilitator() || $user->isSuperFacilitator()
                || ($this->levelable::class == Idea::class && $this->levelable->users->contains($user))
                ) {
                return true;
            }

            $activeLevels = $user
                ->activeStudio
                ->activeChallenges()
                ->map(fn ($challengeVersion, $key) => $challengeVersion->levels)
                ->flatten()
                ->pluck('id');
            // If this challenge is active in the user's studio.
            if ($activeLevels->contains($this->id)) {
                // Allow level start if user already has a start on this or any
                // later level of this ChallengeVersion (e.g. via a team complete).
                foreach ($this->levelable->levels->reverse() as $level) {
                    if ($user->hasStartedLevel($this)) {
                        return true;
                    }
                    if ($this == $level) {
                        break;
                    }
                }

                // If Challenge is startable and it's the first level.
                if ($this->levelable->challenge->isStartable($user)) {
                    // If it's the first level.
                    if ($this->level_number == 1) return true;
                    // If previous level is completed.
                    if ($this->previous() && $user->hasCompletedLevel($this->previous())) return true;
                }
            }

            return false;
        // });
    }

    public function isStarted(User $user): bool
    {
        return $user->hasStartedLevel($this);
    }

    public function isCompleted(User $user): bool
    {
        return $user->hasCompletedLevel($this);
    }

    /**
     * Create a start for this level.
     *
     * @param User $user
     * @param boolean $synthetic
     * @return Start|boolean
     */
    public function start(User $user, bool $synthetic = false): Start|bool
    {
        if ($synthetic || $this->isStartable($user)) {
            $start = Start::firstOrCreate([
                'level_id' => $this->id,
                'user_id' => $user->id,
            ]);
            $user->currentLevel()->associate($this);
            $user->save();
            Log::channel('fuse_activity_log')->info('start_level', ['user' => $user, 'level' => $this]);
            Cache::forget("u{$user->id}_in_progress_challenge_versions");
            Cache::forget("u{$user->id}_started_challenge_versions");
            Cache::put("u{$user->id}_has_started_level_{$this->id}", true, 1800);
            if ($this->levelable::class == ChallengeVersion::class) {
                Cache::put("u{$user->id}_current_level_on_challengeversion_{$this->levelable->id}", $this, 1800);
            }
            return $start;
        }
        return false;
    }
}
