<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('filestack_metadata', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('handle')->unique();
            $table->string('filename');
            $table->string('key');
            $table->string('mimetype');
            $table->unsignedBigInteger('size');
            $table->string('url');
            $table->string('status')->nullable();
            $table->string('location')->nullable();
            $table->string('path')->nullable();
            $table->string('container')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('filestack_metadata');
    }
};
