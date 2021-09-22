<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SchoolTest extends TestCase
{
    private $school;

    protected function setUp(): void
    {
      parent::setUp();
      $this->school = \App\Models\School::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->school);
    }

    public function testSchoolTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('schools', [
            'id',
            'created_at',
            'updated_at',
            'name',
            'district_id',
            'package_id',
            'salesforce_acct_id',
          ]), 1);
    }

    public function testSchoolBelongsToDistrict()
    {
        $this->assertRelationship($this->school, 'district', 'belongsTo');
    }

    public function testSchoolHasManyStudios()
    {
        $this->assertRelationship($this->school, 'studios', 'hasMany');
    }

}
