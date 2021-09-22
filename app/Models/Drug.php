<?php

namespace App\Models;

;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'description',
        'quantity',
        'expiry_date',
        'dosage'
    ];


    protected $dates = ['deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
        'deleted_at' => 'datetime:Y-m-d H:00'
    ];



    public function bills(){
        return $this->belongsToMany(Bill::class);
    }

    public function formulations(){
        return $this->belongsToMany(Formulation::class);
    }

}

