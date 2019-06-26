<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('approved_by')->nullable();
            $table->unsignedInteger('invnum_id')->nullable();
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('supplier_id');
            $table->dateTime('po_date');
            $table->string('po_no');
            $table->string('input_currency');
            $table->string('status');
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
        Schema::dropIfExists('purchase_orders');
    }
}
