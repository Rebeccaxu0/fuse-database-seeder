<?php

namespace Tests\Unit;

use App\Models\Studio;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class StudioTest extends TestCase
{
    private $studio;

    protected function setUp(): void
    {
      parent::setUp();
      $this->studio = Studio::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->studio);
    }

    public function testStudioTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('studios', [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'name',
            'status',
            'school_id',
            'package_id',
            'active',
            'require_email',
            'allow_non_binary_gender_options',
            'allow_comments',
            'allow_ideas',
            'universal_pwd',
            'research_site',
            'in_school',
            'demo_studio',
            'join_code',
            'dashboard_message',
          ]), 1);
    }

    public function testStudioBelongsToSchool()
    {
        $this->assertRelationship($this->studio, 'school', 'belongsTo');
    }


}
