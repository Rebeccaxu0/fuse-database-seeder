<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use Impersonate;
    use Search;
    use Impersonate;

    /**
     * The attributes that are searchable.
     *
     * @var array
     */
    protected $searchable = [
        'name',
        'id',
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
     * The studios associated with this user.
     */
    public function studios()
    {
        return $this->belongsToMany(Studio::class);
    }

    /**
     * The current studio associated with this user.
     */
    public function currentStudio()
    {
        return $this->belongsTo(Studio::class, 'current_studio');
    }

    /**
     * Check if user has admin role.
     */
    public function is_admin()
    {
        return $this->has_role(Role::ADMIN_ID);
    }

    /**
     * Check if user has super facilitator role.
     */
    public function is_super_facilitator()
    {
        return $this->has_role(Role::SUPER_FACILITATOR_ID);
    }

    /**
     * Check if user has facilitator role.
     */
    public function is_facilitator()
    {
        return $this->has_role(Role::FACILITATOR_ID);
    }

    /**
     * Check if user has student role.
     */
    public function is_student()
    {
        return $this->has_role(Role::STUDENT_ID);
    }

    /**
     * Check if user has anonymous student role.
     */
    public function is_anonymous_student()
    {
        return $this->has_role(Role::ANONYMOUS_STUDENT_ID);
    }

    /**
     * User has a given role.
     *
     * @param int $role_id
     *
     * @return boolean
     */
    public function has_role($role_id)
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
        return $this->is_admin();
    }
    /**
     * @return bool
     */
    public function canBeImpersonated(): bool
    {
        return ! $this->is_admin();
    }

    public function startedLevel(Level $level): bool
    {
        return DB::table('level_starts')
            ->where('level', $level->id)
            ->where('user', $this->id)
            ->exists();
    }
}
