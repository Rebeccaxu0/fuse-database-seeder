<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ArtifactTest extends TestCase
{

    private $artifact;

    protected function setUp(): void
    {
      parent::setUp();
      $this->artifact = \App\Models\Artifact::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->artifact);
    }

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

    public function testArtifactMorphToALevel(): void
    {
        $this->assertMorphTo($this->artifact, 'artifactable');
    }

    public function testArtifactHasManyComments(): void
    {
        $this->assertHasMany($this->artifact, 'comments');
    }

    public function testArtifactMorphToManyUsers(): void
    {
        $this->assertMorphToMany($this->artifact, 'users');
    }

}
