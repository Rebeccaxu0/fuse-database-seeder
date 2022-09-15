<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Announcement
 *
 * @property int $id
 * @property string $type
 * @property string|null $url
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $start_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $readers
 * @property-read int|null $readers_count
 * @method static \Database\Factories\AnnouncementFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement newQuery()
 * @method static \Illuminate\Database\Query\Builder|Announcement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Announcement withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Announcement withoutTrashed()
 */
	class Announcement extends \Eloquent {}
}

namespace App\Models{
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
 */
	class Artifact extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Challenge
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string|null $description
 * @property int|null $prerequisite_challenge_id Challenge to complete before starting this one (optional)
 * @property int|null $d7_id
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\ChallengeVersion[] $challengeVersions
 * @property-read int|null $challenge_versions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Challenge[] $dependantChallenges
 * @property-read int|null $dependant_challenges_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Package[] $packages
 * @property-read int|null $packages_count
 * @property-read Challenge|null $prerequisiteChallenge
 * @method static \Database\Factories\ChallengeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge newQuery()
 * @method static \Illuminate\Database\Query\Builder|Challenge onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge wherePrerequisiteChallengeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Challenge withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Challenge withoutTrashed()
 */
	class Challenge extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChallengeCategory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string $description
 * @property int $disapproved
 * @property int|null $d7_id
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\ChallengeVersion[] $challengeVersions
 * @property-read int|null $challenge_versions_count
 * @method static \Database\Factories\ChallengeCategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|ChallengeCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereDisapproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ChallengeCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ChallengeCategory withoutTrashed()
 */
	class ChallengeCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChallengeVersion
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $challenge_id
 * @property int $challenge_category_id
 * @property array $name
 * @property array|null $blurb
 * @property array|null $gallery_note
 * @property array|null $chromebook_info
 * @property string|null $gallery_wistia_video_id
 * @property string|null $gallery_thumbnail_url Wistia video Thumbnail
 * @property string $slug
 * @property int|null $prerequisite_challenge_version_id
 * @property string|null $info_article_url ZenDesk Article URL for facilitators
 * @property int|null $d7_id
 * @property int|null $d7_challenge_id
 * @property int|null $d7_challenge_category_id
 * @property int|null $d7_prereq_challenge_id
 * @property-read \App\Models\Challenge $challenge
 * @property-read \App\Models\ChallengeCategory $challengeCategory
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Idea[] $ideas
 * @property-read int|null $ideas_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Level[] $levels
 * @property-read int|null $levels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Mediable\Media[] $media
 * @property-read int|null $media_count
 * @property-read ChallengeVersion|null $prerequisiteChallengeVersion
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Studio[] $studios
 * @property-read int|null $studios_count
 * @method static \Plank\Mediable\MediableCollection|static[] all($columns = ['*'])
 * @method static \Database\Factories\ChallengeVersionFactory factory(...$parameters)
 * @method static \Plank\Mediable\MediableCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion newQuery()
 * @method static \Illuminate\Database\Query\Builder|ChallengeVersion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereBlurb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereChallengeCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereChallengeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereChromebookInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereD7ChallengeCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereD7ChallengeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereD7PrereqChallengeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereGalleryNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereGalleryThumbnailUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereGalleryWistiaVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereHasMedia($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereHasMediaMatchAll(array $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereInfoArticleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion wherePrerequisiteChallengeVersionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion withMedia($tags = [], bool $matchAll = false, bool $withVariants = false)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion withMediaAndVariants($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion withMediaAndVariantsMatchAll($tags = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeVersion withMediaMatchAll(bool $tags = [], bool $withVariants = false)
 * @method static \Illuminate\Database\Query\Builder|ChallengeVersion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ChallengeVersion withoutTrashed()
 */
	class ChallengeVersion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $body
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $artifact_id
 * @property int $user_id
 * @property int|null $d7_id
 * @property int|null $d7_artifact_id
 * @property string|null $d7_bundle
 * @property-read \App\Models\Artifact|null $artifact
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $seenBy
 * @property-read int|null $seen_by_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CommentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Comment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereArtifactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereD7ArtifactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereD7Bundle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Comment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Comment withoutTrashed()
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ConnectedAccount
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string|null $name
 * @property string|null $nickname
 * @property string|null $email
 * @property string|null $telephone
 * @property string|null $avatar_path
 * @property string $token
 * @property string|null $secret
 * @property string|null $refresh_token
 * @property string|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereAvatarPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectedAccount whereUserId($value)
 */
	class ConnectedAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property int $license_status Active License
 * @property int|null $package_id
 * @property string|null $salesforce_acct_id
 * @property int|null $l_t_i_platform_id
 * @property int|null $d7_id
 * @property-read \App\Models\Package|null $package
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\School[] $schools
 * @property-read int|null $schools_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Studio[] $studios
 * @property-read int|null $studios_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\DistrictFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Query\Builder|District onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLTIPlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLicenseStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereSalesforceAcctId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|District withTrashed()
 * @method static \Illuminate\Database\Query\Builder|District withoutTrashed()
 */
	class District extends \Eloquent {}
}

namespace App\Models{
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
 */
	class GradeLevel extends \Eloquent {}
}

namespace App\Models{
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
 */
	class HelpArticle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Idea
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string|null $body
 * @property int|null $copied_from_level
 * @property int|null $d7_id
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Artifact[] $artifacts
 * @property-read int|null $artifacts_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\ChallengeVersion[] $inspiration
 * @property-read int|null $inspiration_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Level[] $levels
 * @property-read int|null $levels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Start[] $starts
 * @property-read int|null $starts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\IdeaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Idea newQuery()
 * @method static \Illuminate\Database\Query\Builder|Idea onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Idea query()
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereCopiedFromLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Idea withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Idea withoutTrashed()
 */
	class Idea extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LTIPlatform
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $domain
 * @property string $client_id
 * @property string $auth_login_url
 * @property string $auth_token_url
 * @property string $key_set_url
 * @property string $private_key
 * @property string $deployment_json
 * @property string $line_items_url
 * @property string $scope_urls
 * @property string|null $api_token
 * @property string|null $api_secret
 * @property string|null $api_endpoint
 * @property int|null $d7_id
 * @method static \Database\Factories\LTIPlatformFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform newQuery()
 * @method static \Illuminate\Database\Query\Builder|LTIPlatform onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform query()
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereApiEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereApiSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereAuthLoginUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereAuthTokenUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereDeploymentJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereKeySetUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereLineItemsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform wherePrivateKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereScopeUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LTIPlatform withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LTIPlatform withoutTrashed()
 */
	class LTIPlatform extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Level
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $levelable_type
 * @property int $levelable_id
 * @property int|null $level_number Level number must be unique per ChallengeVersion or Idea.
 * 
 * Currently Ideas are limited to one level. To update level number, first
 * set any affected other level number values to NULL, then set them in bulk with:
 * `UPDATE levels SET level_number CASE id WHEN <id> THEN <order> [...] END WHERE id in (<id>, ...)`
 * @property array|null $blurb
 * @property array|null $challenge_desc
 * @property array|null $stuff_you_need_desc
 * @property array|null $get_started_desc
 * @property array|null $how_to_complete_desc
 * @property array|null $get_help_desc
 * @property array|null $power_up_desc
 * @property array|null $facilitator_notes_desc
 * @property int|null $d7_id
 * @property int|null $d7_challenge_version_id
 * @property int|null $d7_prereq_level_id
 * @property int|null $prerequisite_level
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Artifact[] $artifacts
 * @property-read int|null $artifacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $currentUsers
 * @property-read int|null $current_users_count
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $levelable
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Mediable\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Start[] $starts
 * @property-read int|null $starts_count
 * @method static \Plank\Mediable\MediableCollection|static[] all($columns = ['*'])
 * @method static \Database\Factories\LevelFactory factory(...$parameters)
 * @method static \Plank\Mediable\MediableCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Level newQuery()
 * @method static \Illuminate\Database\Query\Builder|Level onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Level query()
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereBlurb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereChallengeDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereD7ChallengeVersionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereD7PrereqLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereFacilitatorNotesDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereGetHelpDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereGetStartedDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereHasMedia($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereHasMediaMatchAll(array $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereHowToCompleteDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereLevelNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereLevelableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereLevelableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level wherePowerUpDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level wherePrerequisiteLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereStuffYouNeedDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level withMedia($tags = [], bool $matchAll = false, bool $withVariants = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Level withMediaAndVariants($tags = [], bool $matchAll = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Level withMediaAndVariantsMatchAll($tags = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Level withMediaMatchAll(bool $tags = [], bool $withVariants = false)
 * @method static \Illuminate\Database\Query\Builder|Level withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Level withoutTrashed()
 */
	class Level extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|Media forPathOnDisk(string $disk, string $path)
 * @method static \Illuminate\Database\Eloquent\Builder|Media inDirectory(string $disk, string $directory, bool $recursive = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Media inOrUnderDirectory(string $disk, string $directory)
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Query\Builder|Media onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media unordered()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereAggregateType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereBasename(string $basename)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereD7Fid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereD7UserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDirectory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereIsOriginal()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereIsVariant(?string $variant_name = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOriginalMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereVariantName($value)
 * @method static \Illuminate\Database\Query\Builder|Media withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Media withoutTrashed()
 */
	class Media extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Organization
 *
 * @property-read \App\Models\Package $package
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\OrganizationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization query()
 */
	class Organization extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Package
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string|null $description
 * @property int $student_activity_tab_access
 * @property int|null $d7_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Challenge[] $challenges
 * @property-read int|null $challenges_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\District[] $districts
 * @property-read int|null $districts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\School[] $schools
 * @property-read int|null $schools_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Studio[] $studios
 * @property-read int|null $studios_count
 * @method static \Database\Factories\PackageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Query\Builder|Package onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereStudentActivityTabAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Package withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Package withoutTrashed()
 */
	class Package extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Partner
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string $description
 * @property int|null $d7_id
 * @property-read \Illuminate\Database\Eloquent\Collection|Partner[] $schools
 * @property-read int|null $schools_count
 * @method static \Database\Factories\PartnerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newQuery()
 * @method static \Illuminate\Database\Query\Builder|Partner onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Partner withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Partner withoutTrashed()
 */
	class Partner extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string|null $description
 * @property int|null $d7_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RoleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Query\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Role withoutTrashed()
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\School
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property int $status
 * @property int|null $district_id
 * @property int|null $package_id
 * @property string|null $salesforce_acct_id
 * @property int|null $partner_id
 * @property int|null $l_t_i_platform_id
 * @property int|null $d7_id
 * @property int|null $d7_partner_id
 * @property-read \App\Models\District|null $district
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GradeLevel[] $gradelevels
 * @property-read int|null $gradelevels_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Package|null $package
 * @property-read \App\Models\Partner|null $partner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Studio[] $studios
 * @property-read int|null $studios_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\SchoolFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|School newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|School newQuery()
 * @method static \Illuminate\Database\Query\Builder|School onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|School query()
 * @method static \Illuminate\Database\Eloquent\Builder|School whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereD7PartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereLTIPlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereSalesforceAcctId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|School withTrashed()
 * @method static \Illuminate\Database\Query\Builder|School withoutTrashed()
 */
	class School extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Start
 *
 * @property int $id
 * @property int $level_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $created_at When user started this level.
 * @property-read \App\Models\Level $level
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\StartFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Start newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Start newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Start query()
 * @method static \Illuminate\Database\Eloquent\Builder|Start whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Start whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Start whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Start whereUserId($value)
 */
	class Start extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read \App\Models\Package|null $package
 * @property-read \App\Models\School|null $school
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\StudioFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Studio newQuery()
 * @method static \Illuminate\Database\Query\Builder|Studio onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Studio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereAllowComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereAllowIdeas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereAllowNonBinaryGenderOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereD7PackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereD7SchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereDashboardMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereDemoStudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereInSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereJoinCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereLTIPlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereRequireEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereResearchSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereUniversalPwd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Studio withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Studio withoutTrashed()
 */
	class Studio extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property int|null $current_connected_account_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $status
 * @property string|null $timezone User's preferred TZ
 * @property string $language Users's preferred language
 * @property string|null $reporting_id Anonymized reporting ID
 * @property string|null $avatar_config FUSE Avatar configuration/generator
 * @property int $seen_idea_trailer
 * @property string|null $last_access
 * @property string|null $login
 * @property string|null $full_name
 * @property string|null $gender Allowed values: 'M', 'F', 'NB' (non-binary), 'U' (prefer not to say)
 * @property string|null $ethnicity Allowed values: african_american, asian, hispanic_latino, middle_eastern, indigenous_american, pacific_islander, caucasian, multiracial, rather_not_say, international (added for Finland)
 * @property string|null $birthday Date of Birth
 * @property string|null $csv_header
 * @property string|null $csv_values
 * @property string|null $guardian
 * @property string|null $email_of_guardian
 * @property string|null $irb_consent
 * @property string|null $photo_consent
 * @property string|null $guardian_irb_consent
 * @property string|null $guardian_photo_consent
 * @property string|null $consent_email_last_sent
 * @property int|null $allow_survey
 * @property int|null $current_level The last level a student is interacted with  (start/save/complete).
 * @property int|null $active_studio The studio a student is currently active within. This is used to determine contents of the challenge gallery among other things.
 * @property int|null $d7_id
 * @property-read \App\Models\Studio|null $activeStudio
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Announcement[] $announcementsSeen
 * @property-read int|null $announcements_seen_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Artifact[] $artifacts
 * @property-read int|null $artifacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $commentsSeen
 * @property-read int|null $comments_seen_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConnectedAccount[] $connectedAccounts
 * @property-read int|null $connected_accounts_count
 * @property-read \App\Models\ConnectedAccount|null $currentConnectedAccount
 * @property-read \App\Models\Level|null $currentLevel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\District[] $districts
 * @property-read int|null $districts_count
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Start[] $ideaStarts
 * @property-read int|null $idea_starts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Idea[] $ideas
 * @property-read int|null $ideas_count
 * @property-read \App\Models\Start|null $latestStart
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Start[] $levelStarts
 * @property-read int|null $level_starts_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\School[] $schools
 * @property-read int|null $schools_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Level[] $startedLevels
 * @property-read int|null $started_levels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Start[] $starts
 * @property-read int|null $starts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Studio[] $studios
 * @property-read int|null $studios_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveStudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAllowSurvey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereConsentEmailLastSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCsvHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCsvValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentConnectedAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailOfGuardian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEthnicity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGuardian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGuardianIrbConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGuardianPhotoConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIrbConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhotoConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereReportingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSeenIdeaTrailer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

