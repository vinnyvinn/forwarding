<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStageComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_components', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stage_id');
            $table->string('name');
            $table->string('type');
            $table->boolean('required')->default(true);
            $table->boolean('notification')->default(true);
            $table->string('timing')->nullable();
            $table->string('description')->nullable();
            $table->text('components')->nullable();
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
        Schema::dropIfExists('stage_components');
    }
}
