<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'licencenumber',
        'cid',
        'gender',
        'mobilenumber',
        'photo',
        'vehiclenumber',
        'vehiclebrand',
        'vehiclecolor',
        'vehicletype',
        'vehiclecapacity',
        'bankaccount',
        'accountnumber',
        'qrcode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // Add the names of attributes that should be hidden here
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // Add attribute casts here
    ];
}
