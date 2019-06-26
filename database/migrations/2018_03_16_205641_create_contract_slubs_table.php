<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractSlubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_slubs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id');
            $table->string('from');
            $table->string('to');
            $table->string('charges');
            $table->string('t_round');
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
        Schema::dropIfExists('contract_slubs');
    }
}
