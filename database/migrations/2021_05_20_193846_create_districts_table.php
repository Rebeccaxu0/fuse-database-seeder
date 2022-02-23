<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('name', 1023);
            // Current bug in MariaDB prevents inserts when unique constraint is added.
            //       ->unique();
            $table->boolean('license_status')
                  ->default(true)
                  ->comment('Active License');
            $table->foreignId('package_id')
                  ->nullable()
                  ->constrained();
            $table->char('salesforce_acct_id', 255)
                  ->unique()
                  ->nullable()
                  ->collation('utf8mb4_bin');
        });

        Schema::create('district_user', function (Blueprint $table) {
          $table->foreignId('district_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
          $table->foreignId('user_id')
                ->onDelete('cascade')
                ->onUpdate('restrict')
                ->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('district_user');
        Schema::dropIfExists('districts');
    }
};

