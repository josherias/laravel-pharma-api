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
            $table->id();
            $table->string('patient_name');
            $table->string('doctor_name')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('temperature')->nullable();
            $table->string('random_blood_sugar')->nullable();
            $table->string('saturation_urine_output')->nullable();
            $table->string('gcs')->nullable();
            $table->string('investigation_plan')->nullable();
            $table->string('final_diagnosis')->nullable();
            $table->string('general_examination')->nullable();
            $table->string('cardiovascular_examination')->nullable();
            $table->string('abdominal_examination')->nullable();
            $table->string('respiratoty_examination')->nullable();
            $table->string('central_nervous_examination')->nullable();
            $table->string('musculo_skeletal_examination')->nullable();
            $table->string('skin_examination')->nullable();
            $table->string('treatment_plan')->nullable();
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
