<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
        });

        Schema::create('role_user', function (Blueprint $table) {
          $table->foreignId('user_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
          $table->foreignId('role_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
    }
}
