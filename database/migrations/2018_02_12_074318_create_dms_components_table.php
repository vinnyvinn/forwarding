<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmsComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_components', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_of_landing_id');
            $table->integer('stage_component_id');
            $table->text('remark')->nullable();
            $table->text('doc_links')->nullable();
            $table->text('text')->nullable();
            $table->text('subchecklist')->nullable();
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
        Schema::dropIfExists('dms_components');
    }
}
