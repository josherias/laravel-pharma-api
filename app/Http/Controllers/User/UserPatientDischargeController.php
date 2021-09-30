<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Models\Discharge;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class UserPatientDischargeController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Patient $patient)
    {

        $rules = [
            'next_appointment' => 'date'
        ];

        $this->validate($request, $rules);

        $dischargeData = $request->all();

        $dischargeData['patient_id'] = $patient->id;
        $dischargeData['patient_name'] = $patient->name;
        $dischargeData['doctor_id'] = $user->id;
        $dischargeData['doctor_name'] = $user->name;


        $discharge = Discharge::create($dischargeData);

        return $this->showOne($discharge, 200);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Patient $patient, Discharge $discharge)
    {
        $rules = [
            'next_appointment' => 'date'
        ];

        $this->validate($request, $rules);

        if($request->has('initial_diagnosis')){
            $discharge->initial_diagnosis = $request->initial_diagnosis;
        }
        if($request->has('investigation_plan')){
            $discharge->investigation_plan = $request->investigation_plan;
        }
        if($request->has('discharge_plan')){
            $discharge->discharge_plan = $request->discharge_plan;
        }
        if($request->has('patient_condition')){
            $discharge->patient_condition = $request->patient_condition;
        }
        if($request->has('final_diagnosis')){
            $discharge->final_diagnosis = $request->final_diagnosis;
        }
        if($request->has('treatment_summary')){
            $discharge->treatment_summary = $request->treatment_summary;
        }
        if($request->has('clinical_summary')){
            $discharge->clinical_summary = $request->clinical_summary;
        }
        if($request->has('next_appointment')){
            $this->validate($request, $rules);
            $discharge->next_appointment = $request->next_appointment;
        }

        if($discharge->isClean()){
            return $this->errorResponse('You must specify a value to update', 422);
        }

        $discharge->save();

        return $this->showOne($discharge, 200);
    }

}
