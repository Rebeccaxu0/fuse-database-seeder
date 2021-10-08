<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LevelTest extends TestCase
{
    private $level;

    protected function setUp(): void
    {
      parent::setUp();
      $this->level = \App\Models\Level::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->level);
    }

    public function testLevelsTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('levels', [
            'id',
            'created_at',
            'updated_at',
            'challenge_version_id',
            'level_number',
        ]), 1);
    }

    public function testLevelBelongsToAChallengeVersion()
    {
        $this->assertRelationship($this->level, 'challengeVersion', 'belongsTo');

    }

    public function testLevelHasManyArtifacts()
    {
        $this->assertRelationship($this->level, 'artifacts', 'morphMany');
    }

}
