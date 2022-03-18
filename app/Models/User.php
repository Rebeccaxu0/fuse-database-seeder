<?php

namespace App\Models;

use App\Models\Artifact;
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
     * The level and idea starts associated with this user.
     */
    public function starts()
    {
        return $this->morphMany(Start::class, 'startable');
    }

    public function startedIdeas()
    {
      return $this->belongsToMany(Idea::class, 'starts', 'user_id', 'startable_id')
                  ->as('start')
                  ->wherePivot('startable_type', 'idea');
    }

    public function startedLevels()
    {
      return $this->belongsToMany(Level::class, 'starts', 'user_id', 'startable_id')
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
     *
     * @return boolean
     */
    public function hasRole($role_id)
    {
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
     * Has started a given Level.
     *
     * @param Level $level
     *
     * @return bool
     */
    public function startedLevel(Level $level): bool
    {
        return Cache::remember("u{$this->id}_has_started_level{$level->id}", 3600, function () use ($level) {
            return $this->startedLevels->contains($level);
        });
    }

    /**
     * Has completed a given Level.
     *
     * @param Level $level
     *
     * @return bool
     */
    public function completedLevel(Level $level): bool
    {
        return Cache::remember("u{$this->id}_has_completed_level{$level->id}", 3600, function () use ($level) {
            return DB::table('artifacts')
                ->join('teams', function ($join) {
                    $join->on('artifacts.id', '=', 'teams.teamable_id')
                        ->where('teams.teamable_type', 'artifact')
                        ->where('teams.user_id', $this->id);
                })
                ->where('type', 'complete')
                ->where('artifactable_type', 'level')
                ->where('artifactable_id', $level->id)
                ->exists();
        });
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
            if ($this->startedLevel($level)) {
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
    public function completedChallengeVersion(ChallengeVersion $challengeVersion): bool
    {
        return $this->completedLevel($challengeVersion->levels->sortBy('level_number')->last());
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
            || $this->startedChallengeVersion($challengeVersion)
            || $this->completedChallengeVersion($challengeVersion->prerequisiteChallengeVersion);
    }

    /**
      * Get a list of Studios the user is a member of, directly or not.
      *
      * @return array [Studio]
     */
    public function deFactoStudios()
    {
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
}
