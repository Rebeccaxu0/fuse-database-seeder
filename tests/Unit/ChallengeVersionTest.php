<?php

namespace Tests\Unit;

use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeVersionTest extends TestCase
{
    use RefreshDatabase;

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
        $challenge = Challenge::factory()->create();
        $challengeCategory = ChallengeCategory::factory()->create();
        $challengeVersion = ChallengeVersion::factory()->create(
          [
            'challenge_id' => $challenge->id,
            'challenge_category_id' => $challengeCategory->id,
          ]);
        $this->assertInstanceOf($challenge::class, $challengeVersion->challenge);
    }

    public function testChallengeVersionBelongsToAChallengeCategory()
    {
        $challenge = Challenge::factory()->create();
        $challengeCategory = ChallengeCategory::factory()->create();
        $challengeVersion = ChallengeVersion::factory()->create(
          [
            'challenge_id' => $challenge->id,
            'challenge_category_id' => $challengeCategory->id,
          ]);
        $this->assertInstanceOf($challengeCategory::class, $challengeVersion->challengeCategory);
    }

    public function testChallengeVersionHasManyLevels()
    {
        $challenge = Challenge::factory()->create();
        $challengeCategory = ChallengeCategory::factory()->create();
        $challengeVersion = ChallengeVersion::factory()->create(
          [
            'challenge_id' => $challenge->id,
            'challenge_category_id' => $challengeCategory->id,
          ]);
        $level = Level::factory()->create(['challenge_version_id' => $challengeVersion->id]);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $challengeVersion->levels);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $challengeVersion->levels());
        $this->assertEquals(1, $challengeVersion->levels->count());
        $this->assertTrue($challengeVersion->levels->contains($level));
    }

}
