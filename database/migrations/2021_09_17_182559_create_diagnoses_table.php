<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_name');
            $table->string('doctor_name')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('temperature')->nullable();
            $table->string('random_blood_sugar')->nullable();
            $table->string('saturation_urine_output')->nullable();
            $table->string('gcs')->nullable();
            $table->longText('investigation_plan')->nullable();
            $table->longText('final_diagnosis')->nullable();
            $table->longText('general_examination')->nullable();
            $table->longText('cardiovascular_examination')->nullable();
            $table->longText('abdominal_examination')->nullable();
            $table->longText('respiratoty_examination')->nullable();
            $table->longText('central_nervous_examination')->nullable();
            $table->longText('musculo_skeletal_examination')->nullable();
            $table->longText('skin_examination')->nullable();
            $table->longText('treatment_plan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnoses');
    }
}
