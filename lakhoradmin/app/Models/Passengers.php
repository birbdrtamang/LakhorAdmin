<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passengers extends Model
{
    use HasFactory;
    protected $table = "passengers";
    public $timestamps = false;

    protected $fillable = [
        'name',
        'cid',
        'gender',
        'mobilenumber',
        'emergencycontactnumber',
    ];
}
