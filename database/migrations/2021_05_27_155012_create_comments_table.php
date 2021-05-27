<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('artifact_id')
                  ->constrained();
            $table->foreignId('user_id')
                  ->constrained();
            $table->longText('body');
        });

        Schema::create('comment_seen', function (Blueprint $table) {
            $table->foreignId('comment_id')
                  ->constrained();
            $table->foreignId('user_id')
                  ->constrained();
            $table->timestamps();
            $table->primary(['comment_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
