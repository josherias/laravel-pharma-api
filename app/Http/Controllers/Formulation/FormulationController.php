<?php

namespace App\Http\Controllers\Formulation;

use App\Http\Controllers\ApiController;
use App\Models\Formulation;
use Illuminate\Http\Request;

class FormulationController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formulations = Formulation::all();

        return $this->showAll($formulations, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required'
        ];

        $this->validate($request, $rules);

        $formulation = Formulation::create($request->all());

        return $this->showOne($formulation, 200);

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formulation  $formulation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formulation $formulation)
    {
        if($request->has('title')){
            $formulation->title = $request->title;
        }

        if($request->has('description')){
            $formulation->description = $request->description;
        }

        if($formulation->isClean()){
            return $this->errorResponse('You must specify a value to update', 422);
        }

        $formulation->save();


        return $this->showOne($formulation, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formulation  $formulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formulation $formulation)
    {
        $formulation->delete();

        return $this->showOne($formulation, 200);
    }
}
