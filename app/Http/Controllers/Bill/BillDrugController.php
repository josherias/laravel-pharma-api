<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\ApiController;
use App\Models\Bill;

class BillDrugController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bill $bill)
    {
        $drugs = $bill->drugs;

        return $this->showAll($drugs, 200);
    }
}
