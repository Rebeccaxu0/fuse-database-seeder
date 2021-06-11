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
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('name');
            $table->unsignedBigInteger('d7_id');
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
            // Migration Columns.
            $table->unsignedBigInteger('d7_uid');
            $table->unsignedBigInteger('d7_rid');
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
