<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePettyCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petty_cashes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->string('employee_number')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('amount');
            $table->boolean('status')->default(0);
            $table->date('deadline');
            $table->text('reason');
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('petty_cashes');
    }
}
