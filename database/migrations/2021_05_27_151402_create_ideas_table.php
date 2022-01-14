<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTable extends Migration
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

        Schema::create('idea_inspirations', function (Blueprint $table) {
            $table->foreignId('idea_id')
                  ->onDelete('cascade')
                  ->onUpdate('restrict')
                  ->constrained();
            $table->foreignId('challenge_version_id')
                  ->onDelete('cascade')
                  ->onUpdate('restrict')
                  ->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('idea_inspirations');
        Schema::dropIfExists('ideas');
    }
}
