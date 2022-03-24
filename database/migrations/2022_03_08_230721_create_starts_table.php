<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('starts', function (Blueprint $table) {
            $table->id();
            $table->string('startable_type', 255);
            $table->unsignedBigInteger('startable_id')
                  ->index();
            $table->foreignId('user_id')
                  ->index()
                  ->constrained()
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->timestamp('created_at')
                  ->useCurrent()
                  ->comment('When user started this level.');
        });
    }

    public function down()
    {
        Schema::dropIfExists('starts');
    }
};
