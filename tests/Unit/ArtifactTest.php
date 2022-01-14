<?php

namespace Tests\Unit;

use App\Models\Artifact;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ArtifactTest extends TestCase
{

    private $artifact;

    protected function setUp(): void
    {
      parent::setUp();
      $this->artifact = Artifact::factory()->make();
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
        ]), 1);
    }

    public function testArtifactBelongsToALevel(): void
    {
        $this->assertRelationship($this->artifact, 'artifactable', 'morphTo');
    }

    public function testArtifactHasManyComments(): void
    {
        $this->assertRelationship($this->artifact, 'comments', 'hasMany');
    }

    public function testArtifactBelongsToManyUsers(): void
    {
        $this->assertRelationship($this->artifact, 'users', 'morphToMany');
    }

}
