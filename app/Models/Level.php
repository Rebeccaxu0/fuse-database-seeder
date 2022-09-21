<?php

namespace App\Models;

use App\Enums\ChallengeStatus;
use App\Exceptions\LevelException;
use App\Models\ChallengeVersion;
use App\Models\Idea;
use App\Models\Start;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Level
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $levelable_type
 * @property int $levelable_id
 * @property int|null $level_number Level number must be unique per ChallengeVersion or Idea.
 * 
 * Currently Ideas are limited to one level. To update level number, first
 * set any affected other level number values to NULL, then set them in bulk with:
 * `UPDATE levels SET level_number CASE id WHEN <id> THEN <order> [...] END WHERE id in (<id>, ...)`
 * @property array|null $blurb
 * @property array|null $challenge_desc
 * @property array|null $stuff_you_need_desc
 * @property array|null $get_started_desc
 * @property array|null $how_to_complete_desc
 * @property array|null $get_help_desc
 * @property array|null $power_up_desc
 * @property array|null $facilitator_notes_desc
 * @property int|null $d7_id
 * @property int|null $d7_challenge_version_id
 * @property int|null $d7_prereq_level_id
 * @property int|null $prerequisite_level
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Artifact[] $artifacts
 * @property-read int|null $artifacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $currentUsers
 * @property-read int|null $current_users_count
 * @property-read array $translations
 * @property-read Model|\Eloquent $levelable
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Mediable\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Start[] $starts
 * @property-read int|null $starts_count
 * @method static \Plank\Mediable\MediableCollection|static[] all($columns = ['*'])
 * @method static \Database\Factories\LevelFactory factory(...$parameters)
 * @method static \Plank\Mediable\MediableCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Level newQuery()
 * @method static \Illuminate\Database\Query\Builder|Level onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Level query()
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereBlurb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereChallengeDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereD7ChallengeVersionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereD7PrereqLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereFacilitatorNotesDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereGetHelpDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereGetStartedDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereHasMedia($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereHasMediaMatchAll(array $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereHowToCompleteDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereLevelNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereLevelableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereLevelableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level wherePowerUpDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level wherePrerequisiteLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereStuffYouNeedDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level withMedia($tags = [], bool $matchAll = false, bool $withVariants = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Level withMediaAndVariants($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Level withMediaAndVariantsMatchAll($tags = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Level withMediaMatchAll(bool $tags = [], bool $withVariants = false)
 * @method static \Illuminate\Database\Query\Builder|Level withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Level withoutTrashed()
 * @mixin \Eloquent
 */
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

            // For Challenge Levels, the Challenge and MetaChallenge
            // must NOT have the status of 'Archive'
            if ($this->levelable->status == ChallengeStatus::Archive
                || $this->levelable->challenge->status == ChallengeStatus::Archive) {
                return false;
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
