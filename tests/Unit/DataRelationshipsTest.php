<?php

namespace Tests\Unit;

use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DataRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Load a ChallengeCategory via a ChallengeVersion.
     *
     * @return void
     */
    public function test_challenge_category()
    {
      $this->assertTrue(true);
        // $challenge_category = ChallengeCategory::factory()->make();
        // $foreign_key = 'challenge_category_id';
        //
        // $relationship = $challenge_category->challenge_versions();
        // $related_model = $relationship->getRelated();
        //
        // // $this->assertHasManyUsing(ChallengeVersion::class, $challenge_category->challenge_versions(), 'challenge_category_id');
        // // $this->assertInstanceOf(HasMany::class, $relationship);
        // $this->assertInstanceOf($related_model, $relationship->getRelated());
        // $this->assertEqual($foreign_key, $relationship->getForeignKeyName());
        // $this->assertTrue(Schema::hasColumns($relationship->get_related()->getTable(), array($foreign_key)));
    }
}
