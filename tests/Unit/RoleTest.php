<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RoleTest extends TestCase
{
    private $role;

    protected function setUp(): void
    {
      parent::setUp();
      $this->role = \App\Models\Role::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->role);
    }

    public function testRoleTableHasExpectedColumns()
    {
        $this->assertTrue(
          Schema::hasColumns('roles', [
            'id',
            'created_at',
            'updated_at',
            'name',
            'description',
          ]), 1);
    }

    public function testRoleBelongsToManyUsers()
    {
        $this->assertRelationship($this->role, 'users', 'belongsToMany');
    }
}
