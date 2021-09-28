<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->double('ammount', 12, 0);
            $table->integer('patient_id')->unsigned();
            $table->string('patient_name');
            $table->integer('category_id')->unsigned();
            $table->string('category_name');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('category_id')->references('id')->on('categories');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
