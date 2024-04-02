<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localroute extends Model
{
    use HasFactory;
    protected $table = "localroute";
    public $timestamps = false;

    protected $fillable = [
        'pickup',
        'destination',
        'fare',
        'date',
    ];
}
