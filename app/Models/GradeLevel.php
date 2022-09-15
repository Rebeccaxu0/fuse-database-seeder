<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\GradeLevel
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string|null $description
 * @property int|null $d7_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\School[] $schools
 * @property-read int|null $schools_count
 * @method static \Database\Factories\GradeLevelFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel newQuery()
 * @method static \Illuminate\Database\Query\Builder|GradeLevel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeLevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|GradeLevel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|GradeLevel withoutTrashed()
 * @mixin \Eloquent
 */
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
