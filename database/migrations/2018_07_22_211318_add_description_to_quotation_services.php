<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToQuotationServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotation_services', function (Blueprint $table) {
            $table->string('purchase_desc')->nullable();
            $table->string('doc_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotation_services', function (Blueprint $table) {
            $table->dropColumn('purchase_desc');
            $table->dropColumn('doc_path');
        });
    }
}
