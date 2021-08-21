<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeVersionTest extends TestCase
{
    private $challengeVersion;

    protected function setUp(): void
    {
      parent::setUp();
      $this->challengeVersion = \App\Models\ChallengeVersion::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->challengeVersion);
    }


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
        $this->assertRelationship($this->challengeVersion, 'challenge', 'belongsTo');
    }

    public function testChallengeVersionBelongsToAChallengeCategory()
    {
        $this->assertRelationship($this->challengeVersion, 'challengeCategory', 'belongsTo');
    }

    public function testChallengeVersionHasManyLevels()
    {
        $this->assertRelationship($this->challengeVersion, 'levels', 'hasMany');
    }

}
