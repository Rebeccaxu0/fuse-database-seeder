<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('challenge_versions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreignId('challenge_id')
                  ->constrained();
            $table->foreignId('challenge_category_id')
                  ->constrained();
            $table->json('name');
            $table->json('blurb')
                  ->nullable();
            $table->json('gallery_note')
                  ->nullable();
            $table->json('chromebook_info')
                  ->nullable();
            // $table->string('gallery_image');
            $table->string('gallery_wistia_video_id')
                  ->nullable();
            $table->string('gallery_thumbnail_url')
                  ->nullable()
                  ->comment('Wistia video Thumbnail');
            $table->string('slug')
                  ->unique()
                  ->nullable(false);
            $table->foreignId('prerequisite_challenge_version_id')
                  ->nullable()
                  ->constrained('challenge_versions')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->string('info_article_url')
                  ->nullable()
                  ->comment('ZenDesk Article URL for facilitators');
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenge_versions');
    }
};

