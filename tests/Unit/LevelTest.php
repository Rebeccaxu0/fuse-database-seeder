<?php

namespace Tests\Unit;

use App\Models\Level;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LevelTest extends TestCase
{
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
        $level = Level::factory()->make();

        $this->assertInstanceOf(BelongsTo::class, $level->challengeVersion());
        $this->assertInstanceOf('App\Models\ChallengeVersion', $level->challengeVersion()->getRelated());

    }

    public function testLevelHasManyArtifacts()
    {
        $level = Level::factory()->make();
        $this->assertInstanceOf(MorphMany::class, $level->artifacts());
        $this->assertInstanceOf(Collection::class, $level->artifacts);
        $this->assertInstanceOf('App\Models\Artifact', $level->artifacts()->getRelated());
    }

}
