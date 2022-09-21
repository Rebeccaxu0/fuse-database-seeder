<?php

namespace App\Models;

use App\Events\StudioDeleting;
use App\Events\StudioSaved;
use App\Models\Package;
use App\Models\Role;
use App\Models\User;
use App\Util\StudioCode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * App\Models\Studio
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property int $status
 * @property int|null $school_id
 * @property int|null $package_id
 * @property int $active
 * @property int $require_email
 * @property int $allow_non_binary_gender_options
 * @property int $allow_comments
 * @property int $allow_ideas
 * @property int $universal_pwd
 * @property int $research_site
 * @property int $in_school
 * @property int $demo_studio
 * @property string|null $join_code
 * @property string|null $dashboard_message
 * @property int|null $l_t_i_platform_id
 * @property int|null $d7_id
 * @property int|null $d7_school_id
 * @property int|null $d7_package_id
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\ChallengeVersion[] $challengeVersions
 * @property-read int|null $challenge_versions_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Package|null $package
 * @property-read \App\Models\School|null $school
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\StudioFactory factory(...$parameters)
 * @method static Builder|Studio newModelQuery()
 * @method static Builder|Studio newQuery()
 * @method static \Illuminate\Database\Query\Builder|Studio onlyTrashed()
 * @method static Builder|Studio query()
 * @method static Builder|Studio whereActive($value)
 * @method static Builder|Studio whereAllowComments($value)
 * @method static Builder|Studio whereAllowIdeas($value)
 * @method static Builder|Studio whereAllowNonBinaryGenderOptions($value)
 * @method static Builder|Studio whereCreatedAt($value)
 * @method static Builder|Studio whereD7Id($value)
 * @method static Builder|Studio whereD7PackageId($value)
 * @method static Builder|Studio whereD7SchoolId($value)
 * @method static Builder|Studio whereDashboardMessage($value)
 * @method static Builder|Studio whereDeletedAt($value)
 * @method static Builder|Studio whereDemoStudio($value)
 * @method static Builder|Studio whereId($value)
 * @method static Builder|Studio whereInSchool($value)
 * @method static Builder|Studio whereJoinCode($value)
 * @method static Builder|Studio whereLTIPlatformId($value)
 * @method static Builder|Studio whereName($value)
 * @method static Builder|Studio wherePackageId($value)
 * @method static Builder|Studio whereRequireEmail($value)
 * @method static Builder|Studio whereResearchSite($value)
 * @method static Builder|Studio whereSchoolId($value)
 * @method static Builder|Studio whereStatus($value)
 * @method static Builder|Studio whereUniversalPwd($value)
 * @method static Builder|Studio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Studio withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Studio withoutTrashed()
 * @mixin \Eloquent
 */
class Studio extends Organization
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
 
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => StudioSaved::class,
        'deleting' => StudioDeleting::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The relationships that should always be eager-loaded.
     *
     * @var array
     */
    protected $with = ['users'];

    /**
     * The Package associated with this studio or the parent School/District.
     */
    public function deFactoPackage()
    {
        if (! $this->assignedPackage() && $this->assignedSchool()) {
            return $this->school->deFactoPackage();
        }
        return $this->package();
    }

    /**
     * The users associated with this studio.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The users currently active in this studio.
     */
    public function actveUsers()
    {
        return $this->users->where('active_studio', $this->id);
    }

    /**
     * The students currently active in this studio.
     */
    public function activeStudents()
    {
        return $this->activeUsers()->doesntHave('roles');
    }

    /**
     * The students associated with this studio.
     */
    public function students()
    {
        return $this->users()->doesntHave('roles');
    }

    /**
     * The facilitators currently active in this studio.
     */
    public function activeFacilitators()
    {
        return $this->school->activeUsers()->whereHas('roles', function (Builder $query) {
            $query->where('id', '=', Role::FACILITATOR_ID);
        });
    }

    /**
     * The facilitators associated with this studio's parent org (school).
     */
    public function facilitators()
    {
        $base = $this->school ? $this->school : $this;
        return $base->users()
            ->whereHas('roles', function (Builder $query) {
                $query->where('id', '=', Role::FACILITATOR_ID);
            });
    }

    /**
     * The super facilitators currently active in this studio.
     */
    public function activeSuperFacilitators()
    {
        return $this->school->district->activeUsers()->whereHas('roles', function (Builder $query) {
            $query->where('id', '=', Role::SUPER_FACILITATOR_ID);
        });
    }

    /**
     * The super facilitators associated with this studio's grandparent org (district).
     */
    public function superFacilitators()
    {
        $base = $this->school && $this->school->district
            ? $this->school->district
            : $this;
        return $base->users()->whereHas('roles', function (Builder $query) {
            $query->where('id', '=', Role::SUPER_FACILITATOR_ID);
        });
    }

    /**
     * The parent org (school) above this studio.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Cacheable function to determine if studio belongs to a school.
     */
    public function assignedSchool() : bool
    {
        return Cache::remember("s{$this->id}_has_school", 1800, fn () => (bool) $this->school );
    }

    /**
     * The grandparent org (district) above this studio.
     */
    public function district()
    {
        return $this->school()->first() ? $this->school()->first()->district() : null;
    }

    /**
     * The package associated with this district.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Cacheable function to determine if studio is directly assigned a package.
     */
    public function assignedPackage() : bool
    {
        return Cache::remember("studio_{$this->id}_has_package", 1800, fn () => (bool) $this->package );
    }

    /**
     * The Challenges a student is allowed to view/start.
     * Always a subset of the challenges in the defacto package.
     */
    public function challengeVersions()
    {
        return $this->belongsToMany(ChallengeVersion::class);
    }

    /**
     * Alias of challengeVersions().
     */
    public function activeChallenges()
    {
        // return Cache::tags(['packages'])
        //     ->remember("studio_{$this->id}_active_challenges", 1800, function () {
                // Only show challengeversions that are allowed by assigned package.
                $challengeVersions = new Collection;
                if ($this->deFactoPackage) {
                    $packageChallenges = $this->deFactoPackage
                                              ->challenges
                                              ->pluck('id');
                    $challengeVersions = $this->challengeVersions
                                              ->load(['challenge', 'levels'])
                                              ->whereIn('challenge_id', $packageChallenges)
                                              ->sortBy('name');
                }
                return $challengeVersions;
        //    });
    }

    /**
     * Try to set a new studio code. Must be unique. Try ten times then fail.
     */
    public function setNewStudioCode(): bool
    {
        $save_status = false;

        for ($i = 0; $i < 10; $i++) {
            $candidate = StudioCode::generate();
            // We should put this in a lock or db transaction if we think
            // multiple simultaneous users will get past the following guard
            // with the same candidate. Unlikely.
            if (Studio::where('join_code', $candidate)->doesntExist()) {
                $this->join_code = $candidate;
                try {
                    $this->save();
                    $save_status = true;
                    break;
                } catch (QueryException $e) {
                    // Ignore query exceptions. Most likely duplicate entry.
                    // Just retry.
                }
            }
        }
        return $save_status;
    }

    public function clearDeFactoStudiosCaches()
    {
        // Find all users affected by the name change and clear their defactostudios.
        foreach ($this->students as $student) {
            Cache::forget("u{$student->id}_studios");
        }
        if ($this->school) {
            foreach ($this->facilitators as $facilitator) {
                Cache::forget("u{$facilitator->id}_studios");
            }
            if ($this->school->district) {
                foreach ($this->superFacilitators as $superFacilitator) {
                    Cache::forget("u{$superFacilitator->id}_studios");
                }
            }
        }
        $staffers = User::whereHas('roles', function (Builder $query) {
            $query->whereIn('id', [Role::ROOT_ID, Role::ADMIN_ID, Role::REPORT_VIEWER_ID, Role::CHALLENGE_AUTHOR_ID]);
        })->get();
        foreach ($staffers as $staff) {
            Cache::forget("u{$staff->id}_studios");
        }
    }
}
