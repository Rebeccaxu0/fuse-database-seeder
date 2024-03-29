<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->longText('url')
                  ->nullable();
            $table->longText('body');
            $table->timestamp('start_at')
                  ->nullable();
            $table->timestamp('end_at')
                  ->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
        });

        Schema::create('announcement_seen', function (Blueprint $table) {
            $table->foreignId('announcement_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('user_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->primary(['announcement_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcement_seen');
        Schema::dropIfExists('announcements');
    }
};
