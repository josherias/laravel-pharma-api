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
        'patient_name',
        'doctor_name',
        'blood_pressure',
        'pulse_rate',
        'respiratory_rate',
        'temperature',
        'random_blood_sugar',
        'saturation_urine_output',
        'gcs',
        'investigation_plan',
        'final_diagnosis',
        'general_examination',
        'cardiovascular_examination',
        'abdominal_examination',
        'respiratoty_examination',
        'central_nervous_examination',
        'musculo_skeletal_examination',
        'skin_examination',
        'treatment_plan',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
