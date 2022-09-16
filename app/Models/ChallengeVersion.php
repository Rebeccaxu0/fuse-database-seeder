<?php

namespace App\Models;

use App\Enums\ChallengeVersionStatus;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\Cache;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\ChallengeVersion
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $challenge_id
 * @property int $challenge_category_id
 * @property array $name
 * @property array|null $blurb
 * @property array|null $gallery_note
 * @property array|null $chromebook_info
 * @property string|null $gallery_wistia_video_id
 * @property string|null $gallery_thumbnail_url Wistia video Thumbnail
 * @property string $slug
 * @property int|null $prerequisite_challenge_version_id
 * @property string|null $info_article_url ZenDesk Article URL for facilitators
 * @property int|null $d7_id
 * @property int|null $d7_challenge_id
 * @property int|null $d7_challenge_category_id
 * @property int|null $d7_prereq_challenge_id
 * @property-read \App\Models\Challenge $challenge
 * @property-read \App\Models\ChallengeCategory $challengeCategory
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Idea[] $ideas
 * @property-read int|null $ideas_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Level[] $levels
 * @property-read int|null $levels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Mediable\Media[] $media
 * @property-read int|null $media_count
 * @property-read ChallengeVersion|null $prerequisiteChallengeVersion
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Studio[] $studios
 * @property-read int|null $studios_count
 * @method static \Plank\Mediable\MediableCollection|static[] all($columns = ['*'])
 * @method static \Database\Factories\ChallengeVersionFactory factory(...$parameters)
 * @method static \Plank\Mediable\MediableCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion newQuery()
 * @method static \Illuminate\Database\Query\Builder|ChallengeVersion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereBlurb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereChallengeCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereChallengeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereChromebookInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereD7ChallengeCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereD7ChallengeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereD7PrereqChallengeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereGalleryNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereGalleryThumbnailUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereGalleryWistiaVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereHasMedia($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereHasMediaMatchAll(array $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereInfoArticleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion wherePrerequisiteChallengeVersionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion withMedia($tags = [], bool $matchAll = false, bool $withVariants = false)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion withMediaAndVariants($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion withMediaAndVariantsMatchAll($tags = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion withMediaMatchAll(bool $tags = [], bool $withVariants = false)
 * @method static \Illuminate\Database\Query\Builder|ChallengeVersion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ChallengeVersion withoutTrashed()
 * @mixin \Eloquent
 */
class ChallengeVersion extends Model
{
    use HasFactory;
    use HasTranslations;
    use Mediable;
    use SoftDeletes;

    public $translatable = [
        'blurb',
        'chromebook_info',
        'facilitator_notes',
        'gallery_note',
        'name',
        'stuff_you_need',
        'summary',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => ChallengeVersionStatus::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blurb',
        'challenge_category_id',
        'challenge_id',
        'chromebook_info',
        'gallery_note',
        'gallery_wistia_video_id',
        'gallery_thumbnail_url',
        'info_article_url',
        'name',
        'prerequisite_challenge_version_id',
        'slug',
        'status',
    ];

    /**
     * The challenge that owns this challenge version.
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    /**
     * The levels associated with this challenge.
     */
    public function levels()
    {
        return $this->morphMany(Level::class, 'levelable');
    }

    /**
     * The Ideas inspired by this challenge.
     */
    public function ideas()
    {
        return $this->belongsToMany(Idea::class, 'idea_inspirations');
    }

    /**
     * The category this Challenge version is tagged with.
     */
    public function challengeCategory()
    {
        return $this->belongsTo(ChallengeCategory::class, 'challenge_category_id');
    }

    /**
     * Prerequisite ChallengeVersion, if any, usually previous level in sequence.
     */
    public function prerequisiteChallengeVersion()
    {
        return $this->belongsTo(ChallengeVersion::class, 'prerequisite_challenge_version_id');
    }

    /**
     * The Studios this challenge is active in.
     */
    public function studios()
    {
        return $this->belongsToMany(Studio::class);
    }

    /**
     * Order the associated levels.
     *
     * @param array $order
     * Array where key is level id and value is order number.
     */
    public function setLevelsOrder(array $order)
    {
        $ids = array_keys($order);
        $case_update_q = 'CASE id ';
        foreach ($order as $id => $level_number) {
            $case_update_q .= "WHEN {$id} THEN {$level_number} ";
        }
        $case_update_q .= 'END';
        $nulls = DB::table('levels')
            ->whereIn('id', $ids)
            ->update(['level_number' => null]);
        $reordered = DB::table('levels')
            ->whereIn('id', $ids)
            ->update(['level_number' => DB::raw($case_update_q)]);
    }

    /**
     * Get the number of students online that have started this challenge.
     */
    public function activeStudents(Studio $studio)
    {
        return 0;
        // TODO: convert code below from Legacy Drupal to Laravel.
        // $others_working = db_select('users', 'u');
        // $others_working->join('field_data_field_current_level', 'c_l', 'c_l.entity_id = u.uid');
        // $others_working->condition('c_l.field_current_level_nid', $list_of_challenge_levels, 'IN');
        // $others_working->join('og_membership', 'og', "og.etid = u.uid AND og.entity_type = 'user'");
        // $others_working
        //   ->condition('u.uid', $exclude_uids_q, 'NOT IN')
        //   ->condition('og.state', 1)
        //   ->condition('og.gid', $studio_nid)
        //   ->condition('og.group_type', 'node');

    }

    /**
     * Get the level a user is most likely going to want to interact with next.
     * Usually this is just the level with the most recent activity, but with
     * the following exceptions.
     *
     * If there's no activity then:
     *   If the parent challenge is startable, return Level 1
     *   Else return NULL.
     *
     * Else
     *   If ChallengeVersion is uncompleted (no 'complete' on last level):
     *     Select the lowest uncompleted level AFTER any completed level
     *     or Level 1.
     *   Else
     *     If ChallengeVersion was just completed, return Level 1
     *        "just completed" means the most recent activity (start or artifact)
     *        for any level of the ChallengeVersion is the challenge-completing
     *        artifact.
     *     Else return the level associated with the most recent activity (start
     *     of artifact).
     *
     * @param User $user
     *
     * @return ?Level
     */
    public function currentLevel(User $user): ?Level
    {
        // return Cache::remember("u{$user->id}_current_level_on_challengeversion_{$this->id}", 1800, function () use ($user) {
            $currentLevel = null;
            $levelIds = $this->levels()->pluck('id');
            // TODO: We could combine get these queries into one.
            $mostRecentArtifact = $user->artifacts()
                                       ->whereIn('level_id', $levelIds)
                                       ->latest()
                                       ->first();
            // Get most recent start from any level in this challenge
            $mostRecentStart    = $user->starts()
                                       ->whereIn('level_id', $levelIds)
                                       ->latest()
                                       ->first();

            // No activity
            if (is_null($mostRecentArtifact) && is_null($mostRecentStart)) {
                if ($this->challenge->isStartable($user)) {
                    $currentLevel = $this->levels()->firstWhere('level_number', '=', 1);
                }
            }

            // Uncompleted
            else if (! $this->isCompleted($user)) {
                // Uncompleted ChallengeVersion guarantees us at least the final
                // level is uncompleted. Continue to backtrack until we find a
                // completed level then break.
                foreach ($this->levels->reverse() as $level) {
                    if (! $level->isCompleted($user)) {
                        $currentLevel = $level;
                    }
                    else break;
                }
            }

            // Completed
            else {
                // Default is first level.
                $currentLevel = $this->levels()->first();

                // If the most recent activity is NOT the ChallengeVersion
                // completion artifact, then use most recent activity level.
                $finalLevel = $this->levels()->latest('level_number')->first();
                $CVCompletionArtifact
                    = $user->artifacts()
                           ->where('type', 'Complete')
                           ->where('level_id', $finalLevel->id)
                           ->oldest()
                           ->first();
                if ($mostRecentStart) {
                    if ($mostRecentStart->create_at > $CVCompletionArtifact->created_at
                        || $mostRecentArtifact->created_at > $CVCompletionArtifact->create_at
                    ) {
                        if ($mostRecentArtifact->created_at > $mostRecentStart->created_at) {
                            $currentLevel = $mostRecentArtifact->level;
                        } else {
                            $currentLevel = $mostRecentStart->level;
                        }
                    }
                }
                // This is pathological - Complete w/o start? Oh well.
                else {
                    $currentLevel = $mostRecentArtifact->level;
                }
            }

            return $currentLevel;
        // });
    }

    /**
     * Get highest Completed level for a given User.
     *
     * @param User $user
     *
     * @return ?Level
     */
    public function highestCompletedLevel(User $user): ?Level
    {
        $complete = Artifact::whereIn('level_id', $this->levels->pluck('id'))
            ->whereRelation('users', 'id', $user->id)
            ->get()
            ->sortBy('level.level_number')
            ->pop();
        return $complete ? $complete->level : null;
    }

    /**
     * Is the challengeVersion completed?
     *
     * @param User $user
     *
     * return Bool
     */
    public function isCompleted(User $user):Bool
    {
        return $this->levels()->latest('level_number')->first()->isCompleted($user);
    }
}

