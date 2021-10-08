<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeCategoryTest extends TestCase
{
    private $challengeCategory;

    protected function setUp(): void
    {
      parent::setUp();
      $this->challengeCategory = \App\Models\ChallengeCategory::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->challengeCategory);
    }

    public function testChallengeCategoriesTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('challenge_categories', [
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
          ]), 1);
    }

    public function testCategoryHasManyChallengeVersions()
    {
        $this->assertRelationship($this->challengeCategory, 'challengeVersions', 'hasMany');
    }
}
