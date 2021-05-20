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
            $table->timestamps();
            $table->string('name', 1023);
            $table->foreignId('school_id')
                  ->constrained()
                  ->nullable();
            $table->foreignId('package_id')
                  ->constrained()
                  ->nullable();
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
        });

        Schema::create('studio_user', function (Blueprint $table) {
          $table->foreignId('studio_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
          $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
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
