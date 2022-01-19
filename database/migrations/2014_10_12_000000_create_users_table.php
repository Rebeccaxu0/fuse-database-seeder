<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->foreignId('current_connected_account_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
        });

        Schema::create('teams', function (Blueprint $table) {
          $table->morphs('teamable');
          $table->foreignId('user_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
        Schema::dropIfExists('users');
    }
}
