<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\HelpArticle
 *
 * @property int $id
 * @property array $name
 * @property array|null $body
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $d7_id
 * @property string|null $d7_alias
 * @property-read array $translations
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Level[] $levels
 * @property-read int|null $levels_count
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle newQuery()
 * @method static \Illuminate\Database\Query\Builder|HelpArticle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle query()
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle whereD7Alias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HelpArticle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|HelpArticle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HelpArticle withoutTrashed()
 * @mixin \Eloquent
 */
class HelpArticle extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    /**
     * The attributes that are translatable.
     *
     * @var string[]
     */
    public $translatable = [
        'name',
        'body',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'body',
    ];

    /**
     * The levels this help article is linked to.
     */
    public function levels()
    {
        return $this->belongsToMany(Level::class)
            ->withPivot(['order']);
    }
}
