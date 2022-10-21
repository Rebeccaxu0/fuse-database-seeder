<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('challenge_versions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('prerequisite_challenge_version_id');
        });
    }

    public function down()
    {
        Schema::table('challenge_versions', function (Blueprint $table) {
            $table->foreignId('prerequisite_challenge_version_id')
                  ->nullable()
                  ->constrained('challenge_versions')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
        });
    }
};
