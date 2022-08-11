<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('help_articles', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('body');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
        });

        // // Help article direct links
        // Schema::create('help_article_level', function (Blueprint $table) {
        //     $table->foreignId('level_id')
        //           ->constrained()
        //           ->onUpdate('cascade')
        //           ->onDelete('cascade');
        //     $table->foreignId('help_article_id')
        //           ->constrained('help_articles')
        //           ->onUpdate('cascade')
        //           ->onDelete('cascade');
        //     $table->unsignedInteger('order');
        //     $table->index('order');
        //     $table->primary(['help_article_id', 'level_id']);
        // });
    }

    public function down()
    {
        // Schema::dropIfExists('help_article_level');
        Schema::dropIfExists('help_articles');
    }
};
