<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routeaccepted extends Model
{
    use HasFactory;
    protected $table = "routeaccepted";
    public $timestamps = false;

    protected $fillable = [
        'd_cid',
        'd_name',
        'p_cid',
        'p_name', 
        'pickup',
        'destination',
        'fare',
        'date'
    ];
}
