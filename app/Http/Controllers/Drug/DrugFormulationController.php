<?php

namespace App\Http\Controllers\Drug;

use App\Http\Controllers\ApiController;
use App\Models\Drug;
use App\Models\Formulation;
use Illuminate\Http\Request;

class DrugFormulationController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Drug $drug)
    {
        $formulations = $drug->formulations;

        return $this->showAll($formulations, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug, Formulation $formulation)
    {
        $drug->formulations()->syncWithoutDetaching([$formulation->id]);

        return $this->showAll($drug->formulations, 200);
    }


    public function destroy(Drug $drug, Formulation $formulation){

        if(!$drug->formulations()->find($formulation->id)){
            return $this->errorResponse('The specified formulation is not a formulation of this drug', 404);
        }

        $drug->formulations()->detach($formulation->id);

        return $this->showAll($drug->formulations, 200);
    }
}
