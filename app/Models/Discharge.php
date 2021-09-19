<?php

namespace App\Models;

use App\Traits\DatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discharge extends Model
{
    use HasFactory, SoftDeletes, DatesTrait;



    protected $fillable = [
        'patient_name',
        'doctor_name',
        'discharge_date',
        'initial_diagnosis',
        'investigation_plan',
        'discharge_plan',
        'patient_condition',
        'final_diagnosis',
        'treatment_summary',
        'clinical_summary',
        'next_appointment'
    ];
}
