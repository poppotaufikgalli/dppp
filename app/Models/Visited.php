<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visited extends Model
{
    protected $table = 'visiteds';
    
    protected $fillable = [
        'tgl',
        'visit_day',
        'visit_month',
        'visit_year',
        'total',
    ];
}
