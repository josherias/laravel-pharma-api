<?php

namespace App\Models;

use App\Traits\DatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formulation extends Model
{
    use HasFactory, SoftDeletes, DatesTrait;


    protected $fillable = [
        'title',
        'description'
    ];


    public function drugs(){
        return $this->belongsToMany(Drug::class);
    }
}
