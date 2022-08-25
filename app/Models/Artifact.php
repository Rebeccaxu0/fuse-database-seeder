<?php

namespace App\Models;

use Filestack\Filelink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;
use Plank\Mediable\Mediable;

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
