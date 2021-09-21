<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';


    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'designation',
        'image',
        'admin',
        'verified',
        'verification_token'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:00',
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

    public function setEmailAttribute($email)  //mutator fr email
    {
        $this->attributes['email'] = strtolower($email); // save all in lower case
    }

    public function isAdmin(){
        return $this->admin == User::ADMIN_USER;
    }

    public function isVerified(){
        return $this->verified == User::ADMIN_USER;
    }

    public static function generateVerificationToken(){
        return Str::random(40);
    }

    public function discharges(){
        return $this->hasMany(Discharge::class);
    }

    public function diagnoses(){
        return $this->hasMany(Diagnosis::class);
    }
}
