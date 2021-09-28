<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\ApiController;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientDischargeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $discharges = $patient->discharges;

        return $this->showAll($discharges);
    }

}
