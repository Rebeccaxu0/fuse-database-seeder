<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
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
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->primary(['comment_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_seen');
        Schema::dropIfExists('comments');
    }
}
