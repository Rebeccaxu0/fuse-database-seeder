<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

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
