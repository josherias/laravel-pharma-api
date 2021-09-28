<?php

namespace App\Http\Controllers\Drug;

use App\Http\Controllers\ApiController;
use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = Drug::all();

        return $this->showAll($drugs, 200);
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
            'name' => 'required',
            'quantity' => 'required|integer',
            'dosage' => 'required',
            'price' => 'required|integer',
            'expiry_date' => 'required'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['price'] = intval($request->price);
        $data['quantity'] = intval($request->quantity);

        $drug = Drug::create($data);


        return $this->showOne($drug, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function show(Drug $drug)
    {
        return $this->showOne($drug, 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {
        $rules = [
            'quantity' => 'integer',
            'price' => 'integer',
        ];

        if($request->has('name')){
            $drug->name = $request->name;
        }
        if($request->has('description')){
            $drug->description = $request->description;
        }
        if($request->has('quantity')){
            $this->validate($request, $rules);
            $drug->quantity = intval($request->quantity);
        }
        if($request->has('dosage')){
            $drug->dosage = intval($request->dosage);
        }
        if($request->has('price')){
            $this->validate($request, $rules);
            $drug->price = intval($request->price);
        }
        if($request->has('expiry_date')){
            $drug->expiry_date = $request->expiry_date;
        }

        if($drug->isClean()){
            return $this->errorResponse('You must specify a value to update', 422);
        }


        $drug->save();

        return $this->showOne($drug, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        $drug->delete();
        return $this->showOne($drug, 200);
    }
}
