<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('challenge_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('name');
            $table->text('description');
            $table->boolean('disapproved')
                ->default(0)
                ->nullable(false)
                ->description('Challenge is not fully tested, or has been deprecated.');
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenge_categories');
    }
};

