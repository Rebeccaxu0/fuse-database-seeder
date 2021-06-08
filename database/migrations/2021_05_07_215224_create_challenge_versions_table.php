<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge_versions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('challenge_id')
                  ->constrained();
            $table->string('name');
            $table->unsignedBigInteger('d7_id');
            $table->unsignedBigInteger('d7_challenge_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenge_versions');
    }
}
