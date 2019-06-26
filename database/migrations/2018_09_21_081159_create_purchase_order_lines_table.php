<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('purchase_order_id');
            $table->string('description');
            $table->string('stock_link');
            $table->string('qty');
            $table->string('rate');
            $table->string('total_amount');
            $table->string('tax_code');
            $table->string('tax_description')->nullable();
            $table->string('tax_id');
            $table->string('tax');
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
        Schema::dropIfExists('purchase_order_lines');
    }
}
