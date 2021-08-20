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
            'd7_id',
            'd7_challenge_version_id',
        ]), 1);
    }

    public function testLevelBelongsToAChallengeVersion()
    {
        $this->assertBelongsTo($this->level, 'challengeVersion');

    }

    public function testLevelMorphManyArtifacts()
    {
        $this->assertMorphMany($this->level, 'artifacts');
    }

}
