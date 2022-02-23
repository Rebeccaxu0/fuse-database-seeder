<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('name', 1023);
            $table->boolean('status')
                  ->default(true);
            $table->foreignId('district_id')
                  ->nullable()
                  ->constrained();
            $table->foreignId('package_id')
                  ->nullable()
                  ->constrained();
            $table->char('salesforce_acct_id', 255)
                  ->unique()
                  ->nullable()
                  ->collation('utf8mb4_bin');
            $table->unique(['name', 'district_id']);
            $table->fullText('name');
        });

        Schema::create('school_user', function (Blueprint $table) {
          $table->foreignId('school_id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->constrained();
          $table->foreignId('user_id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('school_user');
        Schema::dropIfExists('schools');
    }
};

