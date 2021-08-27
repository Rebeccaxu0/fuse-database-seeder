<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreignId('challenge_version_id')
                  ->constrained()
                  ->comment('Parent Challenge Version');
            $table->unsignedTinyInteger('level_number')
                  ->nullable()
                  ->comment('Level number must be unique per challenge. To update level number, first set any affected other level number values to NULL, then set them in bulk with `UPDATE levels SET level_number CASE id WHEN <id> THEN <order> [...] END WHERE id in (<id>, ...)`');
            $table->unique(['challenge_version_id', 'level_number']);
            $table->unsignedBigInteger('prerequisite_level')
                  ->nullable()
                  ->comment('Usually just the prior level (level_number - 1)');
            $table->foreign('prerequisite_level')->references('id')->on('levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
}
