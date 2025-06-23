<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'username',
        'num_countries_returned',
        'countries_details',
    ];
}
