<?php

namespace Tests\Unit;

use App\Models\Challenge;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeTest extends TestCase
{
    private $challenge;

    protected function setUp(): void
    {
      parent::setUp();
      $this->challenge = Challenge::factory()->make();
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
        ]), 1);
    }

    public function testChallengeHasManyChallengeVersions()
    {
        $this->assertRelationship($this->challenge, 'challengeVersions', 'hasMany');
    }

    public function testChallengeBelongsToManyPackages()
    {
        $this->assertRelationship($this->challenge, 'packages', 'belongsToMany');
    }
}
