<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFuseColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status')
                  ->default(1);
            $table->string('timezone', 256)
                  ->nullable()
                  ->default('America/Chicago')
                  ->comment("User's preferred TZ");
            $table->string('language', 12)
                  ->default('en_US')
                  ->comment("Users's preferred language");
            $table->string('reporting_id', 128)
                  ->nullable()
                  ->comment("Anonymized reporting ID");
            $table->timestamp('access')
                  ->nullable()
                  ->index();
            $table->timestamp('login')
                  ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('users', [
            'status',
            'timezone',
            'language',
            'reporting_id',
        ]);
    }
}
