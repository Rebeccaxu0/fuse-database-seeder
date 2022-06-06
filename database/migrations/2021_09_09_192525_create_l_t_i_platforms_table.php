<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('l_t_i_platforms', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('domain', 1023);
            $table->string('client_id', 255);
            $table->string('auth_login_url', 255);
            $table->string('auth_token_url', 255);
            $table->string('key_set_url', 255);
            $table->string('private_key', 2047);
            $table->json('deployment_json', 255);
            $table->string('line_items_url', 255);
            $table->json('scope_urls', 1024);
            $table->string('api_token', 255)->nullable();
            $table->string('api_secret', 255)->nullable();
            $table->string('api_endpoint', 255)->nullable();
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->foreignId('l_t_i_platform_id')
                  ->nullable()
                  ->constrained();
        });

        Schema::table('schools', function (Blueprint $table) {
            $table->foreignId('l_t_i_platform_id')
                  ->nullable()
                  ->constrained();
        });

        Schema::table('studios', function (Blueprint $table) {
            $table->foreignId('l_t_i_platform_id')
                  ->nullable()
                  ->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('l_t_i_platformable');
        Schema::dropIfExists('l_t_i_platforms');
    }
};

