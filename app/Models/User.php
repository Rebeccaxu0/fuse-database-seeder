<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use JoelButcher\Socialstream\HasConnectedAccounts;
use JoelButcher\Socialstream\SetsProfilePhotoFromUrl;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property int|null $current_connected_account_id
 * @property string|null $profile_photo_path
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property int $status
 * @property string|null $timezone User's preferred TZ
 * @property string $language Users's preferred language
 * @property string|null $reporting_id Anonymized reporting ID
 * @property string|null $avatar_config FUSE Avatar configuration/generator
 * @property int $seen_idea_trailer
 * @property string|null $last_access
 * @property string|null $login
 * @property string|null $full_name
 * @property string|null $gender Allowed values: 'M', 'F', 'NB' (non-binary), 'U' (prefer not to say)
 * @property string|null $ethnicity Allowed values: african_american, asian, hispanic_latino, middle_eastern, indigenous_american, pacific_islander, caucasian, multiracial, rather_not_say, international (added for Finland)
 * @property string|null $birthday Date of Birth
 * @property string|null $csv_header
 * @property string|null $csv_values
 * @property string|null $guardian
 * @property string|null $email_of_guardian
 * @property string|null $irb_consent
 * @property string|null $photo_consent
 * @property string|null $guardian_irb_consent
 * @property string|null $guardian_photo_consent
 * @property string|null $consent_email_last_sent
 * @property int|null $allow_survey
 * @property int|null $current_level The last level a student is interacted with  (start/save/complete).
 * @property int|null $active_studio The studio a student is currently active within. This is used to determine contents of the challenge gallery among other things.
 * @property int|null $d7_id
 * @property-read \App\Models\Studio|null $activeStudio
 * @property-read Collection|\App\Models\Announcement[] $announcementsSeen
 * @property-read int|null $announcements_seen_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Artifact[] $artifacts
 * @property-read int|null $artifacts_count
 * @property-read Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Collection|\App\Models\Comment[] $commentsSeen
 * @property-read int|null $comments_seen_count
 * @property-read Collection|\App\Models\ConnectedAccount[] $connectedAccounts
 * @property-read int|null $connected_accounts_count
 * @property-read \App\Models\ConnectedAccount|null $currentConnectedAccount
 * @property-read \App\Models\Level|null $currentLevel
 * @property-read Collection|\App\Models\District[] $districts
 * @property-read int|null $districts_count
 * @property-read string $profile_photo_url
 * @property-read Collection|\App\Models\Start[] $ideaStarts
 * @property-read int|null $idea_starts_count
 * @property-read Collection|\App\Models\Idea[] $ideas
 * @property-read int|null $ideas_count
 * @property-read \App\Models\Start|null $latestStart
 * @property-read Collection|\App\Models\Start[] $levelStarts
 * @property-read int|null $level_starts_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read Collection|\App\Models\School[] $schools
 * @property-read int|null $schools_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Level[] $startedLevels
 * @property-read int|null $started_levels_count
 * @property-read Collection|\App\Models\Start[] $starts
 * @property-read int|null $starts_count
 * @property-read Collection|\App\Models\Studio[] $studios
 * @property-read int|null $studios_count
 * @property-read Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveStudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAllowSurvey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereConsentEmailLastSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCsvHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCsvValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentConnectedAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailOfGuardian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEthnicity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGuardian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGuardianIrbConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGuardianPhotoConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIrbConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhotoConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereReportingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSeenIdeaTrailer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasConnectedAccounts;
    use HasFactory;
    use HasProfilePhoto;
    use Impersonate;
    use Notifiable;
    use Search;
    use Searchable;
    use SetsProfilePhotoFromUrl;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'full_name',
        'birthday',
        'email',
        'password',
        'active_studio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that are searchable.
     *
     * @var string[]
     */
    protected $searchable = [
        'email',
        'full_name',
        'id',
        'name',
    ];

    /**
     * The relationships that should always be loaded.
     */
    protected $with = ['roles'];

    #[SearchUsingFullText(['email', 'full_name', 'name'])]
    /**
      * Laravel Scout fields for search.
     */
    public function toSearchableArray()
    {
        return [
            'email' => $this->email,
            'full_name' => $this->full_name,
            'name' => $this->name,
        ];
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        if (filter_var($this->profile_photo_path, FILTER_VALIDATE_URL)) {
            return $this->profile_photo_path;
        }

        return $this->getPhotoUrl();
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->profile_photo_path
                    ? $this->profile_photo_path
                    // ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
                    : $this->defaultProfilePhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return 'https://avatar.fusestudio.net/fe5b117085efc2df754012bc2a1e7ba9.png';
        // . '?radius=50&b=%23adacac&skinColor[]=%23e0e0e0'
        // . '&hairColor[]=%23707070&hair[]=long06'
        // . '&eyes[]=variant06&eyebrows[]=variant09'
        // . '&mouthColor[]=%23c9c9c9&mouth[]=sad05&'
        // . 'clothesColor[]=%235c5c5c&clothing[]=variant06'
        // . '&beardProbability=0&glassesProbability=0&hatProbability=0&accessoriesProbability=0';
    }

    /**
     * The roles this user is granted.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    /**
     * The artifacts created by this user.
     */
    public function artifacts()
    {
        return $this->belongsToMany(Artifact::class);
    }

    /**
     * The comments created by this user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The ideas created by this user.
     */
    public function ideas()
    {
        return $this->belongsToMany(Idea::class);
    }

    /**
     * The districts associated with this user.
     */
    public function districts()
    {
        return $this->belongsToMany(District::class);
    }

    /**
     * The schools associated with this user.
     */
    public function schools()
    {
        return $this->belongsToMany(School::class);
    }

    /**
     * The last level a user interacted with (start/save/complete).
     */
    public function currentLevel()
    {
        return $this->belongsTo(Level::class, 'current_level');
    }

    /**
     * The Starts for a Level of a ChallengeVersion or Idea associated with this user.
     */
    public function starts()
    {
        return $this->hasMany(Start::class);
    }

    /**
     * The started Levels of a ChallengeVersion or Idea associated with this user.
     */
    public function startedLevels()
    {
        return $this->belongsToMany(Level::class, 'starts', 'user_id', 'level_id');
    }

    /**
     * The idea starts associated with this user.
     */
    public function ideaStarts()
    {
        return $this->hasMany(Start::class)
            ->where('startable_type', 'idea');
    }

    /**
     * The level starts associated with this user.
     */
    public function levelStarts()
    {
        return $this->hasMany(Start::class)
            ->where('startable_type', 'level');
    }

    /**
     * Get the most recent level or idea start associated with this user.
     */
    public function latestStart()
    {
        return $this->hasOne(Start::class)->latestOfMany();
    }

    /**
     * Ideas a user has started.
     */
    public function startedIdeas()
    {
      return $this->startedLevels()
                  ->where('levelable_type', Idea::class);
    }

    /**
     * Levels a user has started.
     */
    public function startedChallengeVersionLevels()
    {
      return $this->startedLevels()
                  ->where('levelable_type', ChallengeVersion::class);
    }

    /**
     * ChallengeVersions a user has started.
     */
    public function startedChallengeVersions()
    {
        return Cache::remember("u{$this->id}_started_challenge_versions", 1800, function () {

            return $this->startedChallengeVersionLevels()
                        ->get()
                        ->unique()
                        ->map(fn($level, $key) => $level->levelable)
                        ->filter(fn($val) => ! is_null($val))
                        ->unique();
        });
    }

    /**
     * The studios associated with this user.
     */
    public function studios()
    {
        return $this->belongsToMany(Studio::class);
    }

    /**
     * The studio a user is currently active within.
     */
    public function activeStudio()
    {
        return $this->belongsTo(Studio::class, 'active_studio');
    }

    /**
     * The announcements marked as having been viewed by this user.
     */
    public function announcementsSeen()
    {
        return $this->belongsToMany(Announcement::class, 'announcement_seen', 'user_id', 'announcement_id');
    }

    /**
     * The comments marked as having been viewed by this user.
     */
    public function commentsSeen()
    {
        return $this->belongsToMany(Comment::class, 'comment_seen', 'user_id', 'comment_id');
    }

    /**
     * Check if user has root role.
     */
    public function isRoot(): bool
    {
        return (bool) $this->roles()->where('role_id', Role::ROOT_ID)->count();
    }

    /**
     * Check if user has a given role.
     */
    public function hasRole(int $roleId): bool
    {
        return Cache::tags(["u{$this->id}_roles"])
            ->remember("u{$this->id}_has_role_{$roleId}", 1800, function () use ($roleId) {
                return (bool) $this->roles()->where('role_id', $roleId)->count();
            });
    }

    /**
     * Check if user has admin role.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(Role::ADMIN_ID);
    }

    /**
     * Check if user has report viewer role.
     */
    public function isReportViewer(): bool
    {
        return $this->hasRole(Role::REPORT_VIEWER_ID)
            || $this->isAdmin();
    }

    /**
     * Check if user has challenge author role.
     */
    public function isChallengeAuthor(): bool
    {
        return $this->hasRole(Role::CHALLENGE_AUTHOR_ID)
            || $this->isAdmin();
    }

    /**
     * Check if user has super facilitator role.
     */
    public function isSuperFacilitator(): bool
    {
        return $this->hasRole(Role::SUPER_FACILITATOR_ID)
            || $this->isAdmin();
    }

    /**
     * Check if user has pre-super facilitator role.
     */
    public function isPreSuperFacilitator(): bool
    {
        return $this->hasRole(Role::PRE_SUPER_FACILITATOR_ID);
    }

    /**
     * Check if user has facilitator role.
     */
    public function isFacilitator(): bool
    {
        return $this->hasRole(Role::FACILITATOR_ID)
            || $this->isSuperFacilitator()
            || $this->isAdmin();
    }

    /**
     * Check if user has pre-facilitator role.
     */
    public function isPreFacilitator(): bool
    {
        return $this->hasRole(Role::PRE_FACILITATOR_ID);
    }

    /**
     * Check if user has student role.
     */
    public function isStudent()
    {
        return Cache::tags(["u{$this->id}_roles"])
            ->remember("u{$this->id}_is_student", 1800, function () {
                return $this->isAnonymousStudent()
                    || ! (bool) $this->roles->count();
            });
    }

    /**
     * Check if user has anonymous student role.
     */
    public function isAnonymousStudent()
    {
        return $this->hasRole(Role::ANONYMOUS_STUDENT_ID);
    }

    /**
     * @return bool
     */
    public function canImpersonate(): bool
    {
        return $this->isAdmin();
    }
    /**
     * @return bool
     */
    public function canBeImpersonated(): bool
    {
        return ! $this->isAdmin();
    }

    /**
     * Is a user actively online now?
     * @return bool
     */
    public function isOnline(): bool
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    /**
     * Has started a given Idea or Level.
     *
     * @param Level $level
     *
     * @return bool
     */
    public function hasStartedLevel(Level $level): bool
    {
        return
            // Cache::remember("u{$this->id}_has_started_level_{$level->id}", 1800,
            // fn() =>
            $this->startedLevels->contains($level);
        // );
    }

    /**
     * Has completed a given Idea or Level.
     *
     * @param Level $level
     *
     * @return bool
     */
    public function hasCompletedLevel(Level $level): bool
    {
        return Cache::remember(
            "u{$this->id}_has_completed_level_{$level->id}",
            1800,
            fn() => Artifact::whereRelation('users', 'id', $this->id)
                ->where('type', 'complete')
                ->where('level_id', $level->id)
                ->exists()
        );
    }

    public function lastActivityOnChallengeVersionOrIdea(ChallengeVersion|Idea $levelable) : string
    {
        $class = class_basename($levelable::class);
        $cacheKey = "u{$this->id}_last_activity_on_{$class}_{$levelable->id}";
        return Cache::remember($cacheKey, 1800, function () use ($levelable) {
            $mostRecent = $base = Carbon::createFromDate(2000, 1, 1);
            foreach ($levelable->levels as $level) {
                if ($artifact = $level->mostRecentArtifact($this)) {
                    if ($artifact->created_at->greaterThan($mostRecent)) {
                        $mostRecent = $artifact->created_at;
                    }
                }
                if ($start = $level->mostRecentStart($this)) {
                    if ($start->created_at->greaterThan($mostRecent)) {
                        $mostRecent = $start->created_at;
                    }
                }
            }

            return $mostRecent->greaterThan($base)
                ? $mostRecent->toDateString()
                : __('Never');
        });
    }

    /**
     * Has started a given ChallengeVersion.
     *
     * @param ChallengeVersion $challengeVersion
     *
     * @return bool
     */
    public function hasStartedChallengeVersion(ChallengeVersion $challengeVersion): bool
    {
        foreach ($challengeVersion->levels as $level) {
            if ($this->hasStartedLevel($level)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Has completed a given ChallengeVersion.
     *
     * @param ChallengeVersion $challengeVersion
     *
     * @return bool
     */
    public function hasCompletedChallengeVersion(?ChallengeVersion $challengeVersion): bool
    {
        return $challengeVersion
            ? $this->hasCompletedLevel($challengeVersion->levels->sortBy('level_number')->last())
            : false;
    }

    /**
     * Has started a given ChallengeVersion.
     *
     * @param ChallengeVersion $challengeVersion
     *
     * @return bool
     */
    public function canStartChallengeVersion(ChallengeVersion $challengeVersion): bool
    {
        // If there's no prerequisite Challenge Version or
        // they've already started it on thier own or via team,
        // let them continue.
        return
            $this->isAdmin()
            || $this->isSuperFacilitator()
            || $this->isFacilitator()
            || (! $challengeVersion->challenge->prerequisiteChallenge)
            || $this->hasStartedChallengeVersion($challengeVersion)
            || $challengeVersion->challenge->prerequisiteChallenge->isCompleted($this);
    }

    public function canStartLevel(Level $level)
    {
        return $level->isStartable($this);
    }

    /**
      * Get a list of Studios the user is a member of, directly or not.
      *
      * @return Collection [Studio]
     */
    public function deFactoStudios()
    {
        return Cache::remember("u{$this->id}_studios", 1800, function () {
            $studios = new Collection;

            if ($this->isSuperFacilitator() || $this->isAdmin()) {
              foreach ($this->districts as $district) {
                foreach ($district->schools as $school) {
                  $studios = $studios->concat($school->studios);
                }
              }
            }

            if ($this->isFacilitator() || $this->isSuperFacilitator() || $this->isAdmin()) {
              foreach ($this->schools as $school) {
                $studios = $studios->concat($school->studios);
              }
            }
            $studios = $studios->concat($this->studios);

            if (! empty($studios)) {
              $studios = $studios->unique()
                                ->sortBy('name', SORT_STRING | SORT_FLAG_CASE)
                                ->sortBy('school.name', SORT_STRING | SORT_FLAG_CASE);
            }
            return $studios;
        });
    }

    /**
      * Get a list of schools the user is a member of, directly or not.
      *
      * @return Collection [Studio]
     */
    public function deFactoSchools()
    {
        $schools = new Collection;
        foreach ($this->deFactoStudios() as $studio) {
            if ($studio->school) {
                $schools = $schools->push($studio->school);
            }
        }

        if ($schools->count() > 0) {
            $schools = $schools->unique()
                               ->sortBy('name', SORT_STRING | SORT_FLAG_CASE)
                               ->sortBy('district.name', SORT_STRING | SORT_FLAG_CASE);
        }
        return $schools;
    }

    /**
      * Get a list of districts the user is a member of, directly or not.
      *
      * @return Collection [District]
     */
    public function deFactoDistricts()
    {
        $districts = new Collection;
        foreach ($this->deFactoStudios() as $studio) {
            if ($studio->school && $studio->school->district) {
                $districts = $districts->push($studio->school->district);
            }
        }

        if ($districts->count() > 0) {
            $districts = $districts->unique()
                               ->sortBy('name', SORT_STRING | SORT_FLAG_CASE);
        }
        return $districts;
    }

    /**
     * Get the level associated with a user's most recent activity
     * (start/save/complete) limited to a given studio.
     *
     * param ?Studio $studio
     * return Level
     */
    // public function mostRecentLevel(?Studio $studio = null): Level
    // {
    //     $studio ??= $this->activeStudio;
    //     $studioLevels
    //         = $studio->activeChallenges()
    //                ->map(fn($challengeversion, $key) => $challengeversion->levels)
    //                ->flatten()
    //                ->pluck('id');
    //     $ideaLevels
    //         = $this->ideas
    //                ->map(fn($idea, $key) => $idea->level)
    //                ->flatten()
    //                ->pluck('id');
    //     $levels = $studioLevels->union($ideaLevels);

    //     $starts = $this->starts->whereIn($levels)->sortDesc();

    // }

    /**
     * Return a user's first or given name.
     *
     * @return string
     */
    function firstName()
    {
      return explode(' ', $this->full_name)[0];
    }

    /**
     * Return a user's last name or family name or surname.
     *
     * @return string
     */
    function lastName()
    {
      $parts = explode(' ', $this->full_name);
      return end($parts);
    }

    /**
     * Return a user's abbreviated last name or family name or surname.
     *
     * @return string
     */
    function abbreviatedLastName()
    {
      $abbreviation = '';
      foreach (explode('-', $this->lastName()) as $subname) {
        $abbreviation .= strtoupper(substr($subname, 0, 1));
      }
      return $abbreviation;
    }
}
