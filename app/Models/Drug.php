<?php

namespace App\Models;

use App\Traits\DatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends Model
{
    use HasFactory, SoftDeletes, DatesTrait;


    protected $fillable = [
        'name',
        'description',
        'quantity',
        'expiry_date',
        'dosage'
    ];


    public function bills(){
        return $this->belongsToMany(Bill::class);
    }

    public function formulations(){
        return $this->belongsToMany(Formulation::class);
    }

}

