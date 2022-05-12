<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->longtext('blurb')->nullable();;
            $table->longtext('challenge_desc')->nullable();;
            $table->longtext('stuff_you_need_desc')->nullable();;
            $table->longtext('get_started_desc')->nullable();;
            $table->longtext('how_to_complete_desc')->nullable();;
            $table->longtext('get_help_desc')->nullable();;
            $table->longtext('power_up_desc')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->dropColumn('blurb', 'challenge_desc', 'stuff_you_need_desc', 'get_started_desc', 'how_to_complete_desc', 'get_help_desc', 'power_up_desc');
        });
    }
};
