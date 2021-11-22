<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'description',
      'student_activity_tab_access',
    ];


    /**
     * The challenges associated with this package.
     */
    public function challenges()
    {
      return $this->belongsToMany(Challenge::class);
    }

    /**
     * The districts associated with this package.
     */
    public function districts()
    {
      return $this->hasMany(District::class);
    }

    /**
     * The schools associated with this package.
     */
    public function schools()
    {
      return $this->hasMany(School::class);
    }

    /**
     * The studios associated with this package.
     */
    public function studios()
    {
      return $this->hasMany(Studio::class);
    }
}
