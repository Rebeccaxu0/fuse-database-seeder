<?php

namespace Tests\Unit;

use App\Models\Partner;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PartnerTest extends TestCase
{
    private $partner;

    protected function setUp(): void
    {
      parent::setUp();
      $this->partner = Partner::factory()->make();
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
          ]), 1);
    }

    public function testPartnerBelongsToManySchools()
    {
        $this->assertRelationship($this->partner, 'schools', 'hasMany');
    }
}
