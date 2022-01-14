<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GradeLevel extends Model
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
      'id',
    ];

    /**
     * The schools associated with this grade level.
     */
    public function schools()
    {
      return $this->belongsToMany(School::class);
    }


}
