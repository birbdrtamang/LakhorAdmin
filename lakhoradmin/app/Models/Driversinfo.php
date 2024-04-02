<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driversinfo extends Model
{
    use HasFactory;
    protected $table = "driversinfo";
    protected $primaryKey = 'cid';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'licencenumber',
        'cid',
        'gender',
        'mobilenumber',
        'vehiclenumber',
        'vehiclebrand',
        'vehiclecolor',
        'vehicletype',
        'vehiclecapacity',
        'filename',
    ];

}
