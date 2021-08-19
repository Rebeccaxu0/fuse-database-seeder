<?php

namespace Tests\Unit;

use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use App\Models\Level;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeVersionTest extends TestCase
{

    public function testChallengeVersionsTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('challenge_versions', [
            'id',
            'created_at',
            'updated_at',
            'challenge_id',
            'challenge_category_id',
            'name',
            'blurb',
            'summary',
            'stuff_you_need',
            'chromebook_info',
            'facilitator_notes',
            'gallery_version_desc_long',
            'gallery_version_desc_short',
            'slug',
            'prerequisite_challenge_version_id',
            'info_article_url',
            'd7_id',
            'd7_challenge_id',
            'd7_challenge_category_id',
            'd7_prereq_challenge_id',
        ]), 1);
    }

   public function testChallengeVersionBelongsToAChallenge()
    {
        $challengeVersion = ChallengeVersion::factory()->make();

        $this->assertInstanceOf(BelongsTo::class, $challengeVersion->challenge());
        $this->assertInstanceOf(Challenge::class, $challengeVersion->challenge()->getRelated());
    }

    public function testChallengeVersionBelongsToAChallengeCategory()
    {
        $challengeVersion = ChallengeVersion::factory()->make();

        $this->assertInstanceOf(BelongsTo::class, $challengeVersion->challengeCategory());
        $this->assertInstanceOf(ChallengeCategory::class, $challengeVersion->challengeCategory()->getRelated());
    }

    public function testChallengeVersionHasManyLevels()
    {
        $challengeVersion = ChallengeVersion::factory()->make();

        $this->assertInstanceOf(Collection::class, $challengeVersion->levels);
        $this->assertInstanceOf(HasMany::class, $challengeVersion->levels());
        $this->assertInstanceOf(Level::class, $challengeVersion->levels()->getRelated());
    }

}
