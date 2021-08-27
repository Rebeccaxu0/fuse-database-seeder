<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('name');
            $table->text('description');
        });

        Schema::table('schools', function (Blueprint $table) {
            $table->foreignId('partner_id')
                  ->nullable()
                  ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
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
}
