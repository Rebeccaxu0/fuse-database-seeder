<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CommentTest extends TestCase
{

    private $comment;

    protected function setUp(): void
    {
      parent::setUp();
      $this->comment = \App\Models\Comment::factory()->make();
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
            'd7_uid',
            'd7_artifact_id',
        ]), 1);
    }

    public function testCommentBelongsArtifact(): void
    {
        $this->assertBelongsTo($this->comment, 'artifact');
    }

    public function testCommentBelongsToUser(): void
    {
      $this->assertBelongsTo($this->comment, 'user');
    }

}
