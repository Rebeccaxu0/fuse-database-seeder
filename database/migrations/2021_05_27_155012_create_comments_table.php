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
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreignId('artifact_id')
                  ->constrained();
            $table->foreignId('user_id')
                  ->constrained();
            $table->longText('body');
            // Migration Columns.
            $table->unsignedBigInteger('d7_artifact_id');
            $table->unsignedBigInteger('d7_uid');
        });

        Schema::create('comment_seen', function (Blueprint $table) {
            $table->foreignId('comment_id')
                  ->constrained();
            $table->foreignId('user_id')
                  ->constrained();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->primary(['comment_id', 'user_id']);
            // Migration Columns.
            $table->unsignedBigInteger('d7_comment_id');
            $table->unsignedBigInteger('d7_uid');
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
