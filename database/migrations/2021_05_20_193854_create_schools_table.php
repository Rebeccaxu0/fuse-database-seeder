<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 1023);
            $table->foreignId('district_id')
                  ->constrained()
                  ->nullable();
            $table->foreignId('package_id')
                  ->constrained()
                  ->nullable();
            $table->string('salesforce_acct_id', 1023)
                  ->unique()
                  ->nullable();
            $table->unique(['name', 'district_id']);
        });

        Schema::create('school_user', function (Blueprint $table) {
          $table->foreignId('school_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
          $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
        Schema::dropIfExists('school_user');
    }
}
