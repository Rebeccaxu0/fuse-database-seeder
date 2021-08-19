<?php

namespace Tests;

use App\Models\Artifact;
use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use App\Models\Level;

use Illuminate\Database\Eloquent\Relations\MorphTo;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    private $challenge;
    private $challengeCategory;
    private $challengeVersion;
    private $level;
    private $artifact;

    public function assertHasManyUsing($related_model, $relationship, $foreign_key)
    {
        $this->assertInstanceOf(HasMany::class, $relationship);
        $this->assertInstanceOf($related_model, $relationship->getRelated());
        $this->assertEqual($foreign_key, $relationship->getForeignKeyName());
        $this->assertTrue(Schema::hasColumns($relationship->get_related()->getTable(), array($foreign_key)));
    }

    public function assertMorphTo($parent, $child, $relationship)
    {
        $this->assertInstanceOf(MorphTo::class, $child->$relationship());
        $this->assertInstanceOf($parent::class, $child->relationship);
    }
}
