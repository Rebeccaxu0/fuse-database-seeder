<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 1023)
                  ->unique();
            $table->foreignId('package_id')
                  ->constrained();
            $table->string('salesforce_acct_id', 1023)
                  ->unique()
                  ->nullable();
        });

        Schema::create('district_user', function (Blueprint $table) {
          $table->foreignId('district_id')
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
        Schema::dropIfExists('districts');
        Schema::dropIfExists('district_user');
    }
}
