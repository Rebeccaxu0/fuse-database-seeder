<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('name');
            $table->text('description')
              ->nullable();
            $table->unsignedBigInteger('prerequisite_challenge_id')
                  ->nullable()
                  ->comment('Challenge to complete before starting this one (optional)');
            $table->foreign('prerequisite_challenge_id')
                  ->references('id')->on('challenges');
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenges');
    }
};

