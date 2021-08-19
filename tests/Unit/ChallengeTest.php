<?php

namespace Tests\Unit;

use App\Models\Challenge;

use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use App\Models\Package;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChallengeTest extends TestCase
{

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
        $challenge = Challenge::factory()->make();

        $this->assertInstanceOf(Collection::class, $challenge->challengeVersions);
        $this->assertInstanceOf(HasMany::class, $challenge->challengeVersions());
        $this->assertInstanceOf(ChallengeVersion::class, $challenge->challengeVersions()->getRelated());
    }

    public function testChallengeBelongsToManyPackages()
    {
        $challenge = Challenge::factory()->make();

        $this->assertInstanceOf(Collection::class, $challenge->packages);
        $this->assertInstanceOf(BelongsToMany::class, $challenge->packages());
        $this->assertInstanceOf(Package::class, $challenge->packages()->getRelated());
    }
}
