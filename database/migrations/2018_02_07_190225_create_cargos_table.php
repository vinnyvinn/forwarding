<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->string('bl_no')->nullable();
            $table->string('cargo_name')->nullable();
            $table->string('vessel_name')->nullable();
            $table->string('location')->nullable();
            $table->string('shipper')->nullable();
            $table->string('destination')->nullable();
            $table->string('shipping_line')->nullable();
            $table->string('entry_number')->nullable();
            $table->string('eta')->nullable();
            $table->string('cargo_qty')->nullable();
            $table->string('cargo_weight')->nullable();
            $table->string('container_no')->nullable();
            $table->string('consignee_name')->nullable();
            $table->string('manifest')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('cargos');
    }
}
