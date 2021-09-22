<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'ammount',
        'patient_id',
        'patient_name',
        'category_id',
        'category_name'
    ];


    protected $dates = ['deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
        'deleted_at' => 'datetime:Y-m-d H:00'
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
