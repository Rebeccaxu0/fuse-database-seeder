<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grade_levels', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('name');
            $table->text('description')
              ->nullable();
        });

        Schema::create('grade_level_school', function (Blueprint $table) {
          $table->foreignId('school_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
          $table->foreignId('grade_level_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
          $table->primary(['school_id', 'grade_level_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grade_level_school');
        Schema::dropIfExists('grade_levels');
    }
};

