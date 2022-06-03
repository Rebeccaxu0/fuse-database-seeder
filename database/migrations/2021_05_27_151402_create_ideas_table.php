<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('name');
            $table->text('body')
                  ->nullable();
            $table->unsignedBigInteger('copied_from_level')
                  ->nullable();
            $table->foreign('copied_from_level')
                  ->references('id')
                  ->on('levels');
        });

        Schema::create('idea_user', function (Blueprint $table) {
            $table->foreignId('idea_id')
                  ->onDelete('cascade')
                  ->onUpdate('restrict')
                  ->constrained();
            $table->foreignId('user_id')
                  ->onDelete('cascade')
                  ->onUpdate('restrict')
                  ->constrained();
            $table->primary(['idea_id', 'user_id']);
        });

        Schema::create('idea_inspirations', function (Blueprint $table) {
            $table->foreignId('idea_id')
                  ->index()
                  ->constrained()
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->foreignId('challenge_version_id')
                  ->index()
                  ->constrained()
                  ->restrictOnDelete()
                  ->cascadeOnUpdate();
            $table->primary(['idea_id', 'challenge_version_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('idea_inspirations');
        Schema::dropIfExists('ideas');
    }
};

