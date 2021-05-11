<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPiiColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // PII
            $table->boolean('full_name');
            $table->string('gender', 12)->index();
            $table->string('ethnicity', 12)->index();
            // If created by CSV import, the mapping and values.
            $table->string('csv_header', 12);
            $table->string('csv_values', 12);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn([
            'full_name',
            'gender',
            'ethnicity',
            'csv_header',
            'csv_values',
          ]);
        });
    }
}
