<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Media as MediableMedia;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Media
 *
 * @property int $id
 * @property int|null $user_id Uploader
 * @property string $disk
 * @property string $directory
 * @property string $filename
 * @property string $extension
 * @property string $mime_type
 * @property string $aggregate_type
 * @property int $size
 * @property string|null $variant_name
 * @property int|null $original_media_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $d7_fid
 * @property int|null $d7_user_id
 * @property-read string $basename
 * @property-read Media|null $originalMedia
 * @property-read \Illuminate\Database\Eloquent\Collection|Media[] $variants
 * @property-read int|null $variants_count
 * @method static Builder|Media forPathOnDisk(string $disk, string $path)
 * @method static Builder|Media inDirectory(string $disk, string $directory, bool $recursive = false)
 * @method static Builder|Media inOrUnderDirectory(string $disk, string $directory)
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Query\Builder|Media onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static Builder|Media unordered()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereAggregateType($value)
 * @method static Builder|Media whereBasename(string $basename)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereD7Fid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereD7UserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDirectory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static Builder|Media whereIsOriginal()
 * @method static Builder|Media whereIsVariant(?string $variant_name = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOriginalMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereVariantName($value)
 * @method static \Illuminate\Database\Query\Builder|Media withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Media withoutTrashed()
 * @mixin \Eloquent
 */
class Media extends MediableMedia
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['alt'];

    protected $fillable = ['alt'];
    // protected $guarded = ['alt'];
}
