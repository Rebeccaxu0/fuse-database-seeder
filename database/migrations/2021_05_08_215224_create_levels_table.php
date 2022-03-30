<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->unsignedBigInteger('levelable_id')
                  ->comment('Parent ChallengeVersion or Idea');
            $table->string('levelable_type')
                  ->comment("Valid levelable types are 'challenge_version' and 'idea'");
            $levelNumberComment = <<<END
Level number must be unique per ChallengeVersion or Idea.

Currently Ideas are limited to one level. To update level number, first
set any affected other level number values to NULL, then set them in bulk with:
`UPDATE levels SET level_number CASE id WHEN <id> THEN <order> [...] END WHERE id in (<id>, ...)`
END;
            $table->unsignedTinyInteger('level_number')
                  ->nullable()
                  ->comment($levelNumberComment);
            $table->unique(['levelable_id', 'levelable_type', 'level_number']);
            $table->unsignedBigInteger('prerequisite_level')
                  ->nullable()
                  ->comment('Usually just the prior level (level_number - 1)');
            $table->foreign('prerequisite_level')
                  ->references('id')->on('levels');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('current_level')
                  ->nullable()
                  ->comment("The level a student is currently working on.");
            $table->foreign('current_level')
                  ->references('id')
                  ->on('levels')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropForeign(['current_level']);
          $table->dropColumn(['current_level']);
        });
        Schema::dropIfExists('levels');
    }
};

