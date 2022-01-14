<?php

namespace Tests\Unit;

use App\Models\Comment;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CommentTest extends TestCase
{

    private $comment;

    protected function setUp(): void
    {
      parent::setUp();
      $this->comment = Comment::factory()->make();
    }

    protected function tearDown(): void
    {
      parent::tearDown();
      unset($this->comment);
    }

    public function testCommentsTableHasExpectedColumns(): void
    {
        $this->assertTrue(
          Schema::hasColumns('comments', [
            'id',
            'created_at',
            'updated_at',
            'artifact_id',
            'user_id',
            'body',
        ]), 1);
    }

    public function testCommentBelongsArtifact(): void
    {
        $this->assertRelationship($this->comment, 'artifact', 'belongsTo');
    }

    public function testCommentBelongsToUser(): void
    {
      $this->assertRelationship($this->comment, 'user', 'belongsTo');
    }

}
