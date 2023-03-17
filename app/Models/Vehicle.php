<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_no',
        'vehicle_exp',
        'vehicle_name',
        'model_year',
        'brand_id',
        'seating_cap',
        'description',
    ];

}
