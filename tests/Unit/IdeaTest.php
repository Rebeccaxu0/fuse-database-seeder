<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class IdeaTest extends TestCase
{
    private $idea;

    protected function setUp(): void
    {
      parent::setUp();
      $this->idea = \App\Models\Idea::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->idea);
    }

    public function testIdeasTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('ideas', [
            'id',
            'created_at',
            'updated_at',
            'name',
            'body',
            'd7_id',
        ]), 1);
    }

    public function testIdeaBelongsToManyUsers()
    {
        $this->assertRelationship($this->idea, 'users', 'morphToMany');

    }

    public function testIdeaHasManyArtifacts()
    {
        $this->assertRelationship($this->idea, 'artifacts', 'morphMany');
    }

    public function testIdeaBelongsToManyInspirationalChallengeVersions()
    {
        $this->assertRelationship($this->idea, 'inspiration', 'belongsToMany');
    }

}
