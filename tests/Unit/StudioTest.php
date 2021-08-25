<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class StudioTest extends TestCase
{
    private $studio;

    protected function setUp(): void
    {
      parent::setUp();
      $this->studio = \App\Models\Studio::factory()->make();
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
            'name',
            'school_id',
            'package_id',
            'active',
            'require_email',
            'restrict_gender_options',
            'disable_ideas',
            'universal_pwd',
            'research_site',
            'in_school',
            'demo_studio',
            'd7_id',
            'd7_school_id',
            'd7_package_id',
          ]), 1);
    }

    public function testStudioBelongsToSchool()
    {
        $this->assertRelationship($this->studio, 'school', 'belongsTo');
    }


}
