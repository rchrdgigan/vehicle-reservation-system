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
        'is_approved'
    ];

    public function assign_vehicle_owner()
    {
        return $this->hasMany(AssignVehicleOwner::class);
    }

    public function assign_vehicle_type()
    {
        return $this->hasMany(AssignVehicleType::class);
    }

    public function vehicle_image()
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
