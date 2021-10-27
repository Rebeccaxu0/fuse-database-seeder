<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('user_id')
                  ->constrained();
            $table->foreignId('level_id')
                  ->nullable()
                  ->constrained();
            $table->date('birthday')
                  ->comment("Date of Birth")
                  ->nullable()
                  ->index();
            $table->string('gender', 2)
                  ->default('U')
                  ->comment("Allowed values: 'M', 'F', 'NB' (non-binary), 'U' (prefer not to say)")
                  ->nullable()
                  ->index();
            $table->string('ethnicity', 63)
                  ->default('rather_not_say')
                  ->comment("Allowed values: african_american, asian, hispanic_latino, middle_eastern, indigenous_american, pacific_islander, caucasian, multiracial, rather_not_say, international (added for Finland)")
                  ->nullable()
                  ->index();
            $table->string('activity_type', 31);
            $table->string('affiliated_studios', 2047);
            $table->foreignId('studio_id')
                  ->constrained();
            $table->string('studio_name', 255);
            $table->string('challenge_title', 2047)
                  ->nullable();
            $table->string('challenge_version', 2047)
                  ->nullable();
            $table->unsignedTinyInteger('level_number')
                  ->nullable();
            $table->foreignId('artifact_id')
                  ->nullable()
                  ->constrained();
            $table->string('artifact_name', 2047)
                  ->nullable();
            $table->string('artifact_url', 2047)
                  ->nullable();
            $table->boolean('is_team_artifact')
                  ->default(0);
            $table->unsignedBigInteger('trigger_activity_id')
                  ->nullable();
            $table->foreign('trigger_activity_id')
                  ->references('id')
                  ->on('activity_log');
            $table->foreignId('school_id')
                  ->nullable()
                  ->constrained();
            $table->string('school_name', 255)
                  ->nullable();
            $table->foreignId('district_id')
                  ->nullable()
                  ->constrained();
            $table->string('district_name', 255)
                  ->nullable();
            $table->boolean('is_idea_level')->default(0);
            $table->boolean('is_facilitator')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_log');
    }
}
