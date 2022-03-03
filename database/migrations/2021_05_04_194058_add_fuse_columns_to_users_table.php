<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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
                  ->unique()
                  ->nullable()
                  ->comment("Anonymized reporting ID");
            $table->string('avatar_config', 255)
                  ->nullable()
                  ->comment("FUSE Avatar configuration/generator");
            $table->boolean('seen_idea_trailer')
                  ->default(0);
            $table->timestamp('last_access')
                  ->nullable()
                  ->index();
            $table->timestamp('login')
                  ->nullable();
        });
    }

    public function down()
    {
        Schema::dropColumns('users', [
            'status',
            'timezone',
            'language',
            'reporting_id',
            'avatar_config',
            'seen_idea_trailer',
            'access',
            'login',
        ]);
    }
};

