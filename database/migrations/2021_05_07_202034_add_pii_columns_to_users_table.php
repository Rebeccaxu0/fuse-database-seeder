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
            $table->boolean('full_name')->nullable();
            $table->string('gender', 2)->default('U')->comment("Allowed values: 'M', 'F', 'NB' (non-binary), 'U' (prefer not to say)")->index();
            $table->string('ethnicity', 32)->default('rather_not_say')->comment("Allowed values: african_american, asian, hispanic_latino, middle_eastern, indigenous_american, pacific_islander, caucasian, multiracial, rather_not_say, international (added for Finland)")->index();
            // If created by CSV import, the mapping and values.
            $table->string('csv_header', 12)->nullable();
            $table->string('csv_values', 12)->nullable();
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
