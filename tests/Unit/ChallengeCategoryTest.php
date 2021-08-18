<?php

namespace Tests\Unit;

use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeCategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testChallengeCategoriesTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('challenge_categories', [
            'id','name', 'description', 'created_at', 'updated_at', 'd7_id'
        ]), 1);
    }

    public function testCategoryHasManyChallengeVersions()
    {
        $challenge = Challenge::factory()->create();
        $challengeCategory = ChallengeCategory::factory()->create();
        $challengeVersion = ChallengeVersion::factory()->create(
          [
            'challenge_id' => $challenge->id,
            'challenge_category_id' => $challengeCategory->id,
          ]);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $challengeCategory->challengeVersions);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $challengeCategory->challengeVersions());
        $this->assertEquals(1, $challengeCategory->challengeVersions->count());
        $this->assertTrue($challengeCategory->challengeVersions->contains($challengeVersion));
    }
}
