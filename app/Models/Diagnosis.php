<?php

namespace App\Models;

use App\Traits\DatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnosis extends Model
{
    use HasFactory, SoftDeletes, DatesTrait;


    protected $fillable = [
        'blood_pressure',
        'pulse_rate',
        'respiratory_rate',
        'temperature',
        'blood_sugar_levels',
        'saturation',
        'urine_output',
        'gcs',
        'investigation_plan',
        'final_diagnosis',
        'general_examination',
        'cadiovascular_examination',
        'abdominal_examination',
        'respiratoty_examination',
        'nervous_sys_examination',
        'skeletal_examination',
        'skin_examination',
        'treatment_plan',
    ];
}
