<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{

    private $user;

    protected function setUp(): void
    {
      parent::setUp();
      $this->user = User::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->user);
    }

    public function testUsersTableHasExpectedColumns(): void
    {
        $this->assertTrue(
          Schema::hasColumns('users', [
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'profile_photo_path',
            'created_at',
            'updated_at',
            'deleted_at',
            // FUSE Columns
            'status',
            'timezone',
            'language',
            'reporting_id',
            // PII Columns
            'full_name',
            'gender',
            'ethnicity',
            'csv_header',
            'csv_values',
        ]), 1);
    }

    public function testTeamsTableHasExpectedColumns(): void
    {
        $this->assertTrue(
          Schema::hasColumns('teams', [
            'teamable_type',
            'teamable_id',
            'user_id',
        ]), 1);
    }

    public function testUserBelongsToManyRoles(): void
    {
      $this->assertRelationship($this->user, 'roles', 'belongsToMany');
    }

    public function testUserBelongsToManyDistricts(): void
    {
        $this->assertRelationship($this->user, 'districts', 'belongsToMany');
    }

    public function testUserBelongsToManySchools(): void
    {
        $this->assertRelationship($this->user, 'schools', 'belongsToMany');
    }

    public function testUserBelongsToManyStudios(): void
    {
        $this->assertRelationship($this->user, 'studios', 'belongsToMany');
    }

    public function testUserHasManyComments(): void
    {
        $this->assertRelationship($this->user, 'comments', 'hasMAny');
    }

    public function testUserHasManyArtifacts(): void
    {
        $this->assertRelationship($this->user, 'artifacts', 'morphedByMany');
    }

    public function testUserHasManyIdeas(): void
    {
        $this->assertRelationship($this->user, 'ideas', 'morphedByMany');
    }

}
