<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_levels', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('name');
            $table->text('description')
              ->nullable();
        });

        Schema::create('grade_level_school', function (Blueprint $table) {
          $table->foreignId('school_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
          $table->foreignId('grade_level_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_level_school');
        Schema::dropIfExists('grade_levels');
    }
}
