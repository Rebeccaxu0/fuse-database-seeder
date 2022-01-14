<?php

namespace Tests\Unit;

use App\Models\Organization;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    private $organization;

    protected function setUp(): void
    {
      parent::setUp();
      $this->organization = Organization::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->organization);
    }

    public function testOrganizationBelongsToAPackage()
    {
        // Organization class is not concrete, so don't check for schema.
        $this->assertRelationship($this->organization, 'package', 'belongsTo', false);
    }

    public function testOrganizationBelongsToManyUsers()
    {
        // Organization class is not concrete, so don't check for schema.
        $this->assertRelationship($this->organization, 'users', 'belongsToMany', false);
    }

}
