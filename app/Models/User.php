<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use JoelButcher\Socialstream\HasConnectedAccounts;
use JoelButcher\Socialstream\SetsProfilePhotoFromUrl;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

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
     * The attributes that are searchable.
     *
     * @var array
     */
    protected $searchable = [
        'email',
        'full_name',
        'id',
        'name',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

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
                    ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
                    : $this->defaultProfilePhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return '/img/default_avatar.jpg';
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
        return $this->morphedByMany(Artifact::class, 'teamable', 'teams');
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
        return $this->morphedByMany(Idea::class, 'teamable', 'teams');
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
      return $this->belongsToMany(Idea::class, 'starts', 'user_id', 'level_id')
                  ->as('start')
                  ->where('level.levelable.levelable_type', 'idea');
    }

    /**
     * Levels a user has started.
     */
    public function startedChallengeLevels()
    {
      return $this->belongsToMany(Level::class, 'starts', 'user_id', 'level_id')
                  ->as('start')
                  ->wherePivot('startable_type', 'level');
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
     * Check if user has admin role.
     */
    public function isAdmin()
    {
        return $this->hasRole(Role::ADMIN_ID);
    }

    /**
     * Check if user has super facilitator role.
     */
    public function isSuperFacilitator()
    {
        return $this->hasRole(Role::SUPER_FACILITATOR_ID);
    }

    /**
     * Check if user has facilitator role.
     */
    public function isFacilitator()
    {
        return $this->hasRole(Role::FACILITATOR_ID);
    }

    /**
     * Check if user has student role.
     */
    public function isStudent()
    {
        return $this->hasRole(Role::STUDENT_ID);
    }

    /**
     * Check if user has anonymous student role.
     */
    public function isAnonymousStudent()
    {
        return $this->hasRole(Role::ANONYMOUS_STUDENT_ID);
    }

    /**
     * User has a given role.
     *
     * @param int $role_id
     * @param bool $fresh
     *
     * @return boolean
     */
    public function hasRole(int $role_id, bool $fresh = false)
    {
        if ($fresh) Cache::forget("u{$this->id}_has_role_{$role_id}");
        return Cache::remember("u{$this->id}_has_role_{$role_id}", 3600, function () use ($role_id) {
            return $this->roles()->where('role_id', $role_id)->get()->count();
        });
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
        return Cache::remember(
            "u{$this->id}_has_started_level_{$level->id}",
            3600,
            fn() => $this->startedLevels->contains($level),
        );
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
            3600,
            fn() => DB::table('artifacts')
                ->join('teams', function ($join) {
                    $join->on('artifacts.id', '=', 'teams.teamable_id')
                         ->where('teams.teamable_type', 'artifact')
                         ->where('teams.user_id', $this->id);
                })
                ->where('type', 'complete')
                ->where('level_id', $level->id)
                ->exists()
        );
    }

    public function lastActivity(ChallengeVersion $challengeVersion)
    {
      if ($this->startedChallengeVersion($challengeVersion)) {
          return 'beep';
      }
      else {
          return __('Never');
      }
    }

    /**
     * Has started a given ChallengeVersion.
     *
     * @param ChallengeVersion $challengeVersion
     *
     * @return bool
     */
    public function startedChallengeVersion(ChallengeVersion $challengeVersion): bool
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
    public function hasCompletedChallengeVersion(ChallengeVersion $challengeVersion): bool
    {
        return $this->hasCompletedLevel($challengeVersion->levels->sortBy('level_number')->last());
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
            || (! $challengeVersion->prerequisiteChallengeVersion)
            || $this->hasStartedChallengeVersion($challengeVersion)
            || $this->hasCompletedChallengeVersion($challengeVersion->prerequisiteChallengeVersion);
    }

    /**
      * Get a list of Studios the user is a member of, directly or not.
      *
      * @param bool $fresh
      * @return array [Studio]
     */
    public function deFactoStudios(bool $fresh = false)
    {
        if ($fresh) Cache::forget("u{$this->id}_studios");
        return Cache::remember("u{$this->id}_studios", 3600, function () {
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
     * Get the level associated with a user's most recent activity
     * (start/save/complete) limited to a given studio.
     *
     * param ?Studio $studio
     * return Level
     */
    public function mostRecentLevel(?Studio $studio = null): Level
    {
        $studio ??= $this->activeStudio;
        $studioLevels
            = $studio->activechallenges
                   ->map(fn($challengeversion, $key) => $challengeversion->levels)
                   ->flatten()
                   ->pluck('id');
        $ideaLevels
            = $this->ideas
                   ->map(fn($idea, $key) => $idea->level)
                   ->flatten()
                   ->pluck('id');
        $levels = $studioLevels->union($ideaLevels);

        $starts = $this->starts->whereIn($levels)->sortDesc();
    }

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
