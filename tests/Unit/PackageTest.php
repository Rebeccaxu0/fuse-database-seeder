<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PackageTest extends TestCase
{
    private $package;

    protected function setUp(): void
    {
      parent::setUp();
      $this->package = \App\Models\Package::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->package);
    }

    public function testPackageTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('packages', [
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
            'student_activity_tab_access',
            'd7_id',
          ]), 1);
    }

    public function testPackageBelongsToManyChallenges()
    {
        $this->assertRelationship($this->package, 'challenges', 'belongsToMany');
    }

    public function testPackageHasManyDistricts()
    {
      $this->assertRelationship($this->package, 'districts', 'hasMany');
    }

    public function testPackageHasManySchools()
    {
      $this->assertRelationship($this->package, 'schools', 'hasMany');
    }

    public function testPackageHasManyStudios()
    {
      $this->assertRelationship($this->package, 'studios', 'hasMany');
    }
}
