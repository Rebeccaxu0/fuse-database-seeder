<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('name', 1023);
            $table->boolean('status')
                  ->default(true);
            $table->foreignId('school_id')
                  ->nullable()
                  ->constrained();
            $table->foreignId('package_id')
                  ->nullable()
                  ->constrained();
            $table->boolean('active')
                  ->default(true);
            $table->boolean('require_email')
                  ->default(false);
            $table->boolean('allow_non_binary_gender_options')
                  ->default(false);
            $table->boolean('allow_comments')
                  ->default(false);
            $table->boolean('allow_ideas')
                  ->default(false);
            $table->boolean('universal_pwd')
                  ->default(false);
            $table->boolean('research_site')
                  ->default(false);
            $table->boolean('in_school')
                  ->default(true);
            $table->boolean('demo_studio')
                  ->default(false);
            $table->string('join_code', 255);
            $table->text('dashboard_message')
                  ->nullable();
        });

        Schema::create('studio_user', function (Blueprint $table) {
          $table->foreignId('studio_id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->constrained();
          $table->foreignId('user_id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->constrained();
        });

        Schema::create('challenge_version_studio', function (Blueprint $table) {
          $table->foreignId('challenge_version_id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->constrained();
          $table->foreignId('studio_id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->constrained();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('active_studio')
                  ->nullable()
                  ->comment("The studio a student is currently active within. This is used to determine contents of the challenge gallery among other things.");
            $table->foreign('active_studio')
                  ->references('id')->on('studios');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropForeign(['active_studio']);
          $table->dropColumn(['active_studio']);
        });
        Schema::dropIfExists('studio_user');
        Schema::dropIfExists('studios');
    }
};

