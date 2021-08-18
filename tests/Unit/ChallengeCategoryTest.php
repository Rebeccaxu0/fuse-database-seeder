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

    /** @test  */
    public function test_challenge_categories_table_has_expected_columns()
    {
        $this->assertTrue(
          Schema::hasColumns('challenge_categories', [
            'id','name', 'description', 'created_at', 'updated_at', 'd7_id'
        ]), 1);
    }

    public function test_category_has_many_challenge_versions()
    {
        $challenge = Challenge::factory()->create();
        $challenge_category = ChallengeCategory::factory()->create();
        $challenge_version = ChallengeVersion::factory()->create(
          [
            'challenge_id' => $challenge->id,
            'challenge_category_id' => $challenge_category->id,
          ]);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $challenge_category->challenge_versions());
        $this->assertEquals(1, $challenge_category->challenge_versions->count());
        $this->assertTrue($challenge_category->challenge_versions->contains($challenge_version));
    }
}
