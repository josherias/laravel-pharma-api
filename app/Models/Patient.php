<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'gender',
        'address',
        'contact',
        'next_of_keen',
        'next_of_keen_contact'
    ];


    protected $dates = ['deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
        'deleted_at' => 'datetime:Y-m-d H:00'
    ];



    public function setNameAttribute($name)  //mutator fr name
    {
        $this->attributes['name'] = $name;
    }

    public function getNameAttribute($name)  //accessor fr name
    {
        return ucwords($name); //return in uppercase frst later
    }


    public function discharges(){
        return $this->hasMany(Discharge::class);

    }


    public function diagnoses(){
        return $this->hasMany(Diagnosis::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }

}
