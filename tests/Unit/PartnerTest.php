<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PartnerTest extends TestCase
{
    private $partner;

    protected function setUp(): void
    {
      parent::setUp();
      $this->partner = \App\Models\Partner::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->partner);
    }

    public function testPartnerTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('partners', [
            'id',
            'created_at',
            'updated_at',
            'name',
            'description',
            'd7_id',
          ]), 1);
    }

    public function testPartnerBelongsToManySchools()
    {
        $this->assertRelationship($this->partner, 'schools', 'hasMany');
    }
}
