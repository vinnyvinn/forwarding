<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillOfLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_of_landings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id');
            $table->string('contract_ids')->nullable();
            $table->string('slub_id')->nullable();
            $table->string('client_notification')->nullable();
            $table->integer('Client_id');
            $table->string('cargo_weight')->nullable();
            $table->string('cost')->nullable();
            $table->string('code_name')->nullable();
            $table->string('file_number')->nullable();
            $table->string('ctm_ref')->nullable();
            $table->string('stage')->nullable();
            $table->string('bl_number')->nullable();
            $table->string('shipper')->nullable();
            $table->string('shipping_line')->nullable();
            $table->string('start')->nullable();
            $table->string('destination')->nullable();
            $table->string('seal_number')->nullable();
            $table->string('distance')->nullable();
            $table->text('desc')->nullable();
            $table->text('remarks')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('bill_of_landings');
    }
}
