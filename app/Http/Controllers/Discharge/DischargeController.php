<?php

namespace App\Http\Controllers\Discharge;

use App\Http\Controllers\ApiController;
use App\Models\Discharge;
use Illuminate\Http\Request;

class DischargeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discharges = Discharge::all();

        return $this->showAll($discharges);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discharge  $discharge
     * @return \Illuminate\Http\Response
     */
    public function show(Discharge $discharge)
    {
        return $this->showOne($discharge, 200);
    }


}
