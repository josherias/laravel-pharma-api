<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser{

    protected function successResponse($data, $status){
        return response()->json($data, $status);
    }

    protected function errorResponse($message, $status){
        return response()->json(['error' => $message, 'status' => $status], $status);
    }


    protected function showOne(Model $instance, $status = 200){
        return $this->successResponse(['data' => $instance, 'status' => $status], $status);
    }


    protected function showAll(Collection $collection, $status = 200){
        return $this->successResponse(['data' => $collection, 'status' => $status], $status);
    }


    protected function showMessage($message, $status = 200){
        return $this->successResponse(['data' => $message, 'status' => $status], $status);
    }
}


