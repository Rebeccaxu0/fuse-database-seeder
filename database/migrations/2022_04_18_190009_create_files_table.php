<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('disk', 255);
            $table->unsignedBigInteger('user_id')
                  ->nullable()
                  ->comment('User that uploaded file');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->text('uri');
            $table->text('filename')
                  ->nullable();
            $table->string('filemime', 255)
                  ->nullable();
            $table->string('type', 127)
                  ->nullable();
            $table->boolean('status')
                  ->default(0);
            $table->unsignedBigInteger('filesize')
                  ->nullable()
                  ->comment('Size in bytes');
        });

        Schema::table('levels', function (Blueprint $table) {
            $table->unsignedBigInteger('preview_image')
                  ->nullable();
            $table->foreign('preview_image')
                  ->references('id')
                  ->on('files')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('levels', function (Blueprint $table) {
          $table->dropForeign(['preview_image']);
          $table->dropColumn(['preview_image']);
        });
        Schema::dropIfExists('files');
    }
};
