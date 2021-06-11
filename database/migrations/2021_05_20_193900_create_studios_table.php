<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('name', 1023);
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
            $table->boolean('restrict_gender_options')
                  ->default(true);
            $table->boolean('disable_ideas')
                  ->default(true);
            $table->boolean('universal_pwd')
                  ->default(false);
            $table->boolean('research_site')
                  ->default(false);
            $table->boolean('in_school')
                  ->default(true);
            $table->boolean('demo_studio')
                  ->default(false);
            // Migration Columns.
            $table->unsignedBigInteger('d7_id');
            $table->unsignedBigInteger('d7_school_id');
            $table->unsignedBigInteger('d7_package_id');
        });

        Schema::create('studio_user', function (Blueprint $table) {
          $table->foreignId('studio_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
          $table->foreignId('user_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
            // Migration Columns.
            $table->unsignedBigInteger('d7_school_id');
            $table->unsignedBigInteger('d7_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studios');
        Schema::dropIfExists('studio_user');
    }
}