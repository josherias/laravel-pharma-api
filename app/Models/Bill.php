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
        'patient_name',
        'category_name'
    ];
}
