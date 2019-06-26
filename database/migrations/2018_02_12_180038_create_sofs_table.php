<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sofs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_of_landing_id');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->string('crane_working')->nullable();
            $table->text('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sofs');
    }
}
