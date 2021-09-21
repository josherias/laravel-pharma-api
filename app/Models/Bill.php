<?php

namespace App\Models;

use App\Traits\DatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes, DatesTrait;


    protected $fillable = [
        'ammount',
        'patient_id',
        'patient_name',
        'category_id',
        'category_name'
    ];


    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function drugs(){
        return $this->belongsToMany(Drug::class);
    }


}
