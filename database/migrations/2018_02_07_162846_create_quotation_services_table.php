<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id');
            $table->integer('service_id');
            $table->text('name');
            $table->string('rate');
            $table->string('stock_link');
            $table->string('selling_price');
            $table->string('tax_code');
            $table->string('tax_description');
            $table->string('tax_id');
            $table->string('tax');
            $table->string('type');
            $table->string('unit');
            $table->string('total_units');
            $table->string('total');
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
        Schema::dropIfExists('quotation_services');
    }
}
