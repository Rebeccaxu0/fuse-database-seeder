<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeTest extends TestCase
{
    private $challenge;

    protected function setUp(): void
    {
      parent::setUp();
      $this->challenge = \App\Models\Challenge::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->challenge);
    }

    public function testChallengesTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('challenges', [
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
            'd7_id',
        ]), 1);
    }

    public function testChallengeHasManyChallengeVersions()
    {
        $this->assertHasMany($this->challenge, 'challengeVersions');
    }

    public function testChallengeBelongsToManyPackages()
    {
        $this->assertBelongsToMany($this->challenge, 'packages');
    }
}
