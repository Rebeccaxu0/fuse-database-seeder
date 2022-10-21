<?php

namespace App\Models;

use App\Enums\ChallengeStatus;
use App\Models\Level;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @property string|null $info_article_url ZenDesk Article URL for facilitators
 * @property int|null $d7_id
 * @property int|null $d7_challenge_id
 * @property int|null $d7_challenge_category_id
 * @property-read \App\Models\Challenge $challenge
 * @property-read \App\Models\ChallengeCategory $challengeCategory
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Idea[] $ideas
 * @property-read int|null $ideas_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Level[] $levels
 * @property-read int|null $levels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Mediable\Media[] $media
 * @property-read int|null $media_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereGalleryNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereGalleryThumbnailUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereGalleryWistiaVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereHasMedia($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereHasMediaMatchAll(array $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereInfoArticleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereName($value)
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
        'status' => ChallengeStatus::class,
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
     * If the parent challenge is not startable, return NULL.
     * Else if there's no activity (start/save/complete) then return Level 1.
     * Else
     *   - if the level of most recent activity is complete
     *   - AND the next level is unstarted
     *   - return the next level.
     * Else return the level of most recent activity.
     *
     * @param User $user
     *
     * @return ?Level
     */
    public function currentLevel(User $user): ?Level
    {
        // return Cache::remember("u{$user->id}_current_level_on_challengeversion_{$this->id}", 1800, function () use ($user) {
        $currentLevel = null;
        $levelIds = $this->levels()->pluck('id')->all();
        $mostRecentStartLevel = DB::table('starts')
            ->select('created_at', 'level_id')
            ->where('user_id', $user->id)
            ->whereIn('level_id', $levelIds)
            ->orderBy('created_at', 'desc')
            ->limit(1);
        $mostRecenttArtifactLevel = DB::table('artifacts', 'a')
            ->leftJoin('artifact_user', 'a.id', '=', 'artifact_user.artifact_id')
            ->select('a.created_at', 'a.level_id')
            ->where('artifact_user.user_id', $user->id)
            ->whereIn('a.level_id', $levelIds)
            ->orderBy('created_at', 'desc')
            ->limit(1);
        $mostRecentLevel = $mostRecentStartLevel
            ->union($mostRecenttArtifactLevel)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->get();

        // If there's any activity, return the associated most recent level.
        if ($mostRecentLevel->count() > 0) {
            $currentLevel = $this->levels->find($mostRecentLevel->first()->level_id);
            $next = $currentLevel->next();
            // Return most recent level UNLESS this level is completed
            // AND there's a next level AND the next level is unstarted
            if (
                $currentLevel->isCompleted($user)
                && $next instanceof Level
                && ! $user->hasStartedLevel($next)
            ) {
                $currentLevel = $next;
            }
        }
        // Otherwise, just return level 1.
        else {
            $currentLevel = $this->levels()->firstWhere('level_number', '=', 1);
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
