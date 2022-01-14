<?php

namespace Tests\Unit;

use App\Models\ChallengeVersion;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeVersionTest extends TestCase
{
    private $challengeVersion;

    protected function setUp(): void
    {
      parent::setUp();
      $this->challengeVersion = ChallengeVersion::factory()->make();
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

    public function testChallengeVersionBelongsToManyInspiredIdeas()
    {
        $this->assertRelationship($this->challengeVersion, 'ideas', 'belongsToMany');
    }

    public function testChallengeVersionHasOnePrerequisiteChallengeVersion()
    {
        $this->assertRelationship($this->challengeVersion, 'prerequisiteChallengeVersion', 'hasOne');
    }

}
