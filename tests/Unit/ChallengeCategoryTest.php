<?php

namespace Tests\Unit;

use App\Models\ChallengeCategory;

use App\Models\ChallengeVersion;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeCategoryTest extends TestCase
{

    public function testChallengeCategoriesTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('challenge_categories', [
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
            'd7_id',
          ]), 1);
    }

    public function testCategoryHasManyChallengeVersions()
    {
        $challengeCategory = ChallengeCategory::factory()->make();
        $this->assertInstanceOf(Collection::class, $challengeCategory->challengeVersions);
        $this->assertInstanceOf(HasMany::class, $challengeCategory->challengeVersions());
        $this->assertInstanceOf(ChallengeVersion::class, $challengeCategory->challengeVersions()->getRelated());
    }
}
