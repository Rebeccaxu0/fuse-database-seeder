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
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('name', 1023)
                  ->unique();
            $table->foreignId('package_id')
                  ->nullable()
                  ->constrained();
            $table->string('salesforce_acct_id', 1023)
                  ->nullable()
                  ->unique();
            // Migration Columns.
            $table->unsignedBigInteger('d7_id');
            $table->unsignedBigInteger('d7_package_id');
        });

        Schema::create('district_user', function (Blueprint $table) {
          $table->foreignId('district_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
          $table->foreignId('user_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
            // Migration Columns.
            $table->unsignedBigInteger('d7_district_id');
            $table->unsignedBigInteger('d7_uid');
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
