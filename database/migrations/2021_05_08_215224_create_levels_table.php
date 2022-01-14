<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelsTable extends Migration
{
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreignId('challenge_version_id')
                  ->constrained()
                  ->comment('Parent Challenge Version');
            $table->unsignedTinyInteger('level_number')
                  ->nullable()
                  ->comment('Level number must be unique per challenge. To update level number, first set any affected other level number values to NULL, then set them in bulk with `UPDATE levels SET level_number CASE id WHEN <id> THEN <order> [...] END WHERE id in (<id>, ...)`');
            $table->unique(['challenge_version_id', 'level_number']);
            $table->unsignedBigInteger('prerequisite_level')
                  ->nullable()
                  ->comment('Usually just the prior level (level_number - 1)');
            $table->foreign('prerequisite_level')
                  ->references('id')->on('levels');
        });

        Schema::create('level_starts', function (Blueprint $table) {
            $table->foreignId('level_id')
                  ->onDelete('cascade')
                  ->onUpdate('restrict')
                  ->constrained();
            $table->foreignId('user_id')
                  ->onDelete('cascade')
                  ->onUpdate('restrict')
                  ->constrained();
            $table->timestamp('created_at')
                  ->useCurrent()
                  ->comment('When user started this level.');
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
}
