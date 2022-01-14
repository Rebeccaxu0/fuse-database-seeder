<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
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
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
