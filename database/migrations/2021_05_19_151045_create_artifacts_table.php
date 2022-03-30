<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('artifacts', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreignId('level_id')
                  ->constrain()
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
            $table->string('type', 63)
                  ->default('Complete')
                  ->comment("Valid values: 'Save', 'Complete'");
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->boolean('request_feedback')->default(0);
            $table->boolean('request_feedback_complete')->default(0);
            $table->string('url', 2048)->nullable();
            $table->string('url_title', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artifacts');
    }
};

