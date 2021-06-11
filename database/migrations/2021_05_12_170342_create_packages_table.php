<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('name');
            $table->text('description')
                ->nullable();
            $table->boolean('student_activity_tab_access');
            $table->unsignedBigInteger('d7_id');
        });

        Schema::create('challenge_package', function (Blueprint $table) {
          $table->foreignId('challenge_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
          $table->foreignId('package_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
          $table->unsignedBigInteger('d7_challenge_id');
          $table->unsignedBigInteger('d7_package_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
        Schema::dropIfExists('challenge_package');
    }
}
