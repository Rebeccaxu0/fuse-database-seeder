<?php

namespace App\Models;

use Filestack\Filelink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;
use Plank\Mediable\Mediable;

/**
 * App\Models\Artifact
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $level_id
 * @property string $type Valid values: 'save', 'complete'
 * @property string|null $name
 * @property string|null $notes
 * @property string|null $filestack_handle
 * @property string|null $url
 * @property string|null $url_title
 * @property int|null $d7_id
 * @property int|null $d7_comment_id
 * @property int|null $d7_filestack_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\Level|null $level
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Mediable\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Plank\Mediable\MediableCollection|static[] all($columns = ['*'])
 * @method static \Database\Factories\ArtifactFactory factory(...$parameters)
 * @method static \Plank\Mediable\MediableCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact newQuery()
 * @method static \Illuminate\Database\Query\Builder|Artifact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereD7CommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereD7FilestackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereFilestackHandle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereHasMedia($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereHasMediaMatchAll(array $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact whereUrlTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact withMedia($tags = [], bool $matchAll = false, bool $withVariants = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact withMediaAndVariants($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact withMediaAndVariantsMatchAll($tags = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Artifact withMediaMatchAll(bool $tags = [], bool $withVariants = false)
 * @method static \Illuminate\Database\Query\Builder|Artifact withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Artifact withoutTrashed()
 * @mixin \Eloquent
 */
class Artifact extends Model
{
    use HasFactory;
    use Mediable;
    use SoftDeletes;

    protected $with = ['users'];

    /**
     * The users that created this artifact.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The comments attached to this Artifact.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the parent level.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Get the URL to the raw artifact, if a file.
     *
     * @return string
     */
    public function getPreviewUrl(): string|null
    {
        // If a URL or NOT an image/video, then use the challenge gallery image
        // for the parent ChallengeVersion or if Idea the first inspiration.
        $media = $this->firstMedia('file');
        if ($this->url || ($this->getAggregateMimeType() != 'image' && $this->getAggregateMimeType() != 'video')) {
            if (get_class($this->level->levelable) == ChallengeVersion::class) {
                $challengeVersion = $this->level->levelable;
            }
            else {
                $challengeVersion = $this->level->levelable->inspiration->first();
            }
            if (! $challengeVersion) {
                return null;
            }
            if (! $challengeVersion->gallery_thumbnail_url) {
                $wistia = Http::get('http://fast.wistia.net/oembed?url=http://home.wistia.com/medias/' . $challengeVersion->gallery_wistia_video_id);
                $challengeVersion->gallery_thumbnail_url = $wistia->json('thumbnail_url');
                $challengeVersion->save();
            }
            return $challengeVersion->gallery_thumbnail_url;
        }
        // ...else try to use Filestack to resize the image for preview.
        else if ($this->filestack_handle) {
            $fskey = config('filestack.api_key');
            $filelink = new Filelink($this->filestack_handle, $fskey);
            if ($this->getAggregateMimeType() == 'image') {
                return $filelink->resize('336', '189', 'crop', 'faces')
                            ->transform_url;
            }
            return $filelink->url();
        }
        elseif ($media) {
            return $media->getUrl();
        }

        return null;
    }

    /**
     * Get the URL to the raw artifact, if a file.
     *
     * @return string
     */
    public function getRawFileUrl(): string|null
    {
        // Return CDN URL if possible
        if (! $this->url && $this->filestack_handle) {
            return 'https://cdn.filestackcontent.com/' . $this->filestack_handle;
        }

        if (! $this->url && $media = $this->firstMedia('file')) {
            return $media->getUrl();
        }

        return null;
    }

    /**
     * Get a URL to the artifact, if a file,
     * and set Content-Disposition to "Attachment" to force download.
     *
     * @return string
     */
    public function getDownloadUrl(): string|null
    {
        // Return CDN URL if possible
        if (! $this->url && $this->filestack_handle) {
            return 'https://cdn.filestackcontent.com/'
            . config('filestack.api_key')
            . '/content=t:attachment/'
            . $this->filestack_handle;
        }

        // We should try to guarantee that the below is on the same domain for
        // the 'download' HTML link attribute to work.
        if (! $this->url && $media = $this->firstMedia('file')) {
            return $media->getUrl();
        }

        return null;
    }

    public function getAggregateMimeType()
    {
        if ($this->url) {
            return 'url';
        }

        $media = $this->firstMedia('file');
        if ($media) {
            return $media->aggregate_type;
        }
        else if ($this->filestack_handle) {
            $fskey = config('filestack.api_key');
            $filelink = new Filelink($this->filestack_handle, $fskey);
            // Should insert a media record in at this point.
            $mime = $filelink->getMetaData()['mimetype'];
            $aggregate_array = explode('/', $mime);
            return $aggregate_array[0];
        }
        return 'unknown';
    }
}
