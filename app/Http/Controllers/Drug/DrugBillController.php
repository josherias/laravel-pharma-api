<?php

namespace App\Http\Controllers\Drug;

use App\Http\Controllers\ApiController;
use App\Models\Drug;


class DrugBillController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Drug $drug)
    {
        $bills = $drug->bills;

        return $this->showAll($bills, 200);
    }

}
