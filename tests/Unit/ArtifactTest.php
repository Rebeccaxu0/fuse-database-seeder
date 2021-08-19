<?php

namespace Tests\Unit;

use App\Models\Artifact;

use App\Models\Idea;
use App\Models\Level;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ArtifactTest extends TestCase
{

    public function testArtifactTableHasExpectedColumns(): void
    {
        $this->assertTrue(
          Schema::hasColumns('artifacts', [
            'id',
            'created_at',
            'updated_at',
            'artifactable_type',
            'artifactable_id',
            'type',
            'name',
            'notes',
            'request_feedback',
            'request_feedback_complete',
            'url',
            'url_title',
            'd7_id',
        ]), 1);
    }

    public function testArtifactBelongsToALevelOrIdea(): void
    {
        $artifact = Artifact::factory()->make();

        $this->assertInstanceOf(MorphTo::class, $artifact->artifactable());
        $this->assertEquals(Level::class, $artifact->artifactable()->morphMap()['level']);
        $this->assertEquals(Idea::class, $artifact->artifactable()->morphMap()['idea']);
    }

    // public function testArtifactHasManyUsers(): void
    // {
    //     $this->assertTrue(false);
    // }

}
