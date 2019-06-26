<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_of_landing_id');
            $table->string('driver_name')->nullable();
            $table->string('feu')->nullable();
            $table->string('teu')->nullable();
            $table->string('lcl')->nullable();
            $table->string('truck_no')->nullable();
            $table->string('container_reg')->nullable();
            $table->string('tonne')->nullable();
            $table->string('buying')->nullable();
            $table->string('cost')->nullable();
            $table->dateTime('depart')->nullable();
            $table->dateTime('arrival')->nullable();
            $table->dateTime('return')->nullable();
            $table->double('turn_around')->nullable();
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
        Schema::dropIfExists('transports');
    }
}
