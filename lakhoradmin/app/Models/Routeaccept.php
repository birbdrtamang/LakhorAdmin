<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routeaccept extends Model
{
    use HasFactory;
    protected $table = "routeaccept";
    public $timestamps = false;
    
    protected $fillable = [
        'user_cid',
        'pickup',
        'destination',
        'fare',
        'date',
    ];
}
