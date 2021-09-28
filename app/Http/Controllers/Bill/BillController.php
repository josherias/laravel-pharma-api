<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\ApiController;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::all();

        return $this->showAll($bills, 200);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        return $this->showOne($bill, 200);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return $this->showOne($bill, 200);
    }
}
