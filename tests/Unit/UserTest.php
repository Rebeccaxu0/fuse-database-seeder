<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{

    private $user;

    protected function setUp(): void
    {
      parent::setUp();
      $this->user = \App\Models\User::factory()->make();
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
            'd7_id',
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
        $this->assertBelongsToMany($this->user, 'roles');
    }

    public function testUserBelongsToManyDistricts(): void
    {
        $this->assertBelongsToMany($this->user, 'districts');
    }

    public function testUserBelongsToManySchools(): void
    {
        $this->assertBelongsToMany($this->user, 'schools');
    }

    public function testUserBelongsToManyStudios(): void
    {
        $this->assertBelongsToMany($this->user, 'studios');
    }

    public function testUserHasManyComments(): void
    {
        $this->assertHasMany($this->user, 'comments');
    }

    public function testUserHasManyArtifacts(): void
    {
        $this->assertMorphedByMany($this->user, 'artifacts');
    }

    public function testUserHasManyIdeas(): void
    {
        $this->assertMorphedByMany($this->user, 'ideas');
    }

}
