<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('name');
            $table->text('body')
              ->nullable();

            // Migration Columns.
            $table->unsignedBigInteger('d7_id')
              ->default(1);
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
            // Migration Columns.
            $table->unsignedBigInteger('d7_idea_id');
            $table->unsignedBigInteger('d7_challenge_version_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ideas');
    }
}
