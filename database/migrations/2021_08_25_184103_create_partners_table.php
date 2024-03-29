<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->string('name');
            $table->text('description');
        });

        Schema::table('schools', function (Blueprint $table) {
            $table->foreignId('partner_id')
                  ->nullable()
                  ->constrained();
        });
    }

    public function down()
    {
        if (Schema::hasColumns('schools', ['partner_id'])) {
          Schema::table('schools', function(Blueprint $table) {
            $table->dropForeign(['partner_id']);
          });
            Schema::dropColumns('schools', ['partner_id']);
        }
        Schema::dropIfExists('partners');
    }
};

