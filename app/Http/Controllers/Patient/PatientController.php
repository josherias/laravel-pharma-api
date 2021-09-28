<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\ApiController;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();

        return $this->showAll($patients, 200);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //rules
        $rules = [
            'name' => 'required|unique:patients',
            'gender' => 'required|in:male,female',
            'contact' => 'required'
        ];

        //validation
        $this->validate($request, $rules);

        $patientData = $request->all();

        $patient = Patient::create($patientData);

        return $this->showOne($patient, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return $this->showOne($patient, 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $rules = [
            'name' => 'unique:patients,name,' . $patient->id,
            'gender' => 'in:male,female',
        ];

        if($request->has('name')){
            if($request->name == null){
                return $this->errorResponse('Name field cannot be empty', 409);
            }

            $patient->name = $request->name;
        }

        if($request->has('gender')){
            $this->validate($request, $rules);
            $patient->gender = $request->gender;
        }

        if($request->has('contact')){
            $patient->contact = $request->contact;
        }


        if($request->has('next_of_keen')){
            $patient->next_of_keen = $request->next_of_keen;
        }


        if($request->has('next_of_keen_contact')){
            $patient->next_of_keen_contact = $request->next_of_keen_contact;
        }

        if($patient->isClean()){
            return $this->errorResponse('You must specify a value to update', 422);
        }


        $patient->save();

        return $this->showOne($patient, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return $this->showOne($patient, 200);
    }
}
