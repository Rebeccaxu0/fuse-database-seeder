<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artifacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->morphs('artifactable');
            $table->string('type', 63)
                  ->default('Complete')
                  ->comment("Valid values: 'Save', 'Complete'");
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->boolean('request_feedback')->default(0);
            $table->boolean('request_feedback_complete')->default(0);
            $table->string('url', 2048)->nullable();
            $table->string('url_title', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artifacts');
    }
}
