<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDischargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discharges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->string('patient_name');
            $table->integer('doctor_id')->unsigned();
            $table->string('doctor_name')->nullable();
            $table->longText('initial_diagnosis')->nullable();
            $table->longText('investigation_plan')->nullable();
            $table->longText('discharge_plan')->nullable();
            $table->longText('patient_condition')->nullable();
            $table->longText('final_diagnosis')->nullable();
            $table->longText('treatment_summary')->nullable();
            $table->longText('clinical_summary')->nullable();
            $table->dateTime('next_appointment')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discharges');
    }
}
