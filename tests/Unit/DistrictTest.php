<?php

namespace Tests\Unit;

use App\Models\District;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DistrictTest extends TestCase
{
    private $district;

    protected function setUp(): void
    {
      parent::setUp();
      $this->district = District::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->district);
    }

    public function testDistrictTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('districts', [
            'id',
            'created_at',
            'updated_at',
            'name',
            'package_id',
            'salesforce_acct_id',
          ]), 1);
    }

    public function testDistrictHasManySchools()
    {
        $this->assertRelationship($this->district, 'schools', 'hasMany');
    }

}
