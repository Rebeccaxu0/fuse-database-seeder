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
            $table->timestamp('start')
                  ->nullable();
            $table->timestamp('end')
                  ->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
        });

        Schema::create('announcement_seen', function (Blueprint $table) {
            $table->foreignId('announcement_id')
                  ->constrained();
            $table->foreignId('user_id')
                  ->constrained();
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
