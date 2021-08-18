<?php

namespace Tests\Unit;

use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeTest extends TestCase
{
    use RefreshDatabase;

    public function testChallengeTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('challenges', [
            'id','name', 'description', 'created_at', 'updated_at', 'd7_id'
        ]), 1);
    }

    public function testChallengeHasManyChallengeVersions()
    {
        $challenge = Challenge::factory()->create();
        $challengeCategory = ChallengeCategory::factory()->create();
        $challengeVersion = ChallengeVersion::factory()->create(
          [
            'challenge_id' => $challenge->id,
            'challenge_category_id' => $challengeCategory->id,
          ]);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $challenge->challengeVersions);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $challenge->challengeVersions());
        $this->assertInstanceOf($challengeVersion::class, $challenge->challengeVersions()->first());
        $this->assertEquals(1, $challenge->challengeVersions->count());
        $this->assertTrue($challenge->challengeVersions->contains($challengeVersion));
    }

    public function testChallengeBelongsToManyPackages()
    {
        $challenge = Challenge::factory()->create();
        $package = Package::factory()->create();
        $challenge->packages()->attach($package);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $challenge->packages);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsToMany', $challenge->packages());
        $this->assertInstanceOf($package::class, $challenge->packages()->first());
    }
}
