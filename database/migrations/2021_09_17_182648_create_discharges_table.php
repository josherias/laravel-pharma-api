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
            $table->id();
            $table->integer('patient_id');
            $table->string('patient_name');
            $table->integer('doctor_id');
            $table->string('doctor_name')->nullable();
            $table->string('initial_diagnosis')->nullable();
            $table->string('investigation_plan')->nullable();
            $table->string('discharge_plan')->nullable();
            $table->string('patient_condition')->nullable();
            $table->string('final_diagnosis')->nullable();
            $table->string('treatment_summary')->nullable();
            $table->string('clinical_summary')->nullable();
            $table->string('next_appointment')->nullable();
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
