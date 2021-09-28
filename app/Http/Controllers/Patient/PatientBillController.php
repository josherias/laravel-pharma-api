<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\ApiController;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Drug;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientBillController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {

        $bills = $patient->bills;

        return $this->showAll($bills);
    }



      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {

        $rules = [
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|integer',
            'drugs_list' => 'required'
        ];

        $this->validate($request, $rules);

        $drugs = json_decode($request->drugs_list);

        $quantity = $request->quantity;

        $ammount = 0;


        $category = Category::findOrFail($request->category_id);


        return DB::transaction(function () use ($quantity, $ammount, $patient, $category, $drugs) {

            foreach($drugs as $drug){
                $drug = Drug::find($drug);
                // $drug->quantity -= $quantity;
                $sum = $drug->price * $quantity;
                $ammount += $sum;
            }

            $bill = Bill::create([
                'quantity' => intval($quantity),
                'ammount' => $ammount,
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'category_id' => $category->id,
                'category_name' => $category->name,
            ]);

            foreach($drugs as $drug){
                $bill->drugs()->syncWithoutDetaching([$drug]);
            }


            return $this->showOne($bill, 200);
        });

    }


}
