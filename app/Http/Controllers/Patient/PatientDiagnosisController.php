<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\ApiController;
use App\Models\Diagnosis;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientDiagnosisController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $diagnoses = $patient->diagnoses;

        return $this->showAll($diagnoses, 200);
    }

}
