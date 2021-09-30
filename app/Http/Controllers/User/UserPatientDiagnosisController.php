<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class UserPatientDiagnosisController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Patient $patient)
    {

     $diagnosisData = $request->all();

     $diagnosisData['patient_id'] = $patient->id;
     $diagnosisData['patient_name'] = $patient->name;
     $diagnosisData['doctor_id'] = $user->id;
     $diagnosisData['doctor_name'] = $user->name;


     $diagnosis = Diagnosis::create($diagnosisData);

     return $this->showOne($diagnosis, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Patient $patient, Diagnosis $diagnosis)
    {

        if($request->has('blood_pressure')){
            $diagnosis->blood_pressure = $request->blood_pressure;
        }
        if($request->has('pulse_rate')){
            $diagnosis->pulse_rate = $request->pulse_rate;
        }
        if($request->has('respiratory_rate')){
            $diagnosis->respiratory_rate = $request->respiratory_rate;
        }
        if($request->has('temperature')){
            $diagnosis->temperature = $request->temperature;
        }
        if($request->has('random_blood_sugar')){
            $diagnosis->random_blood_sugar = $request->random_blood_sugar;
        }
        if($request->has('saturation_urine_output')){
            $diagnosis->saturation_urine_output = $request->saturation_urine_output;
        }
        if($request->has('gcs')){
            $diagnosis->gcs = $request->gcs;
        }
        if($request->has('investigation_plan')){
            $diagnosis->investigation_plan = $request->investigation_plan;
        }
        if($request->has('final_diagnosis')){
            $diagnosis->final_diagnosis = $request->final_diagnosis;
        }
        if($request->has('general_examination')){
            $diagnosis->general_examination = $request->general_examination;
        }
        if($request->has('cardiovascular_examination')){
            $diagnosis->cardiovascular_examination = $request->cardiovascular_examination;
        }
        if($request->has('abdominal_examination')){
            $diagnosis->abdominal_examination = $request->abdominal_examination;
        }
        if($request->has('respiratoty_examination')){
            $diagnosis->respiratoty_examination = $request->respiratoty_examination;
        }
        if($request->has('central_nervous_examination')){
            $diagnosis->central_nervous_examination = $request->central_nervous_examination;
        }
        if($request->has('musculo_skeletal_examination')){
            $diagnosis->musculo_skeletal_examination = $request->musculo_skeletal_examination;
        }
        if($request->has('skin_examination')){
            $diagnosis->skin_examination = $request->skin_examination;
        }
        if($request->has('treatment_plan')){
            $diagnosis->treatment_plan = $request->treatment_plan;
        }

        if($diagnosis->isClean()){
            return $this->errorResponse('You must specify a value to update', 422);
        }

        $diagnosis->save();

        return $this->showOne($diagnosis, 200);

    }

}
