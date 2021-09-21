<?php

namespace App\Models;

use App\Traits\DatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, DatesTrait;


    protected $fillable = [
        'name',
        'description'
    ];


    public function bills(){
        return $this->hasMany(Bill::class);
    }
}
