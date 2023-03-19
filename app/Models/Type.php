<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    public function assign_vehicle_type()
    {
        return $this->hasMany(AssignVehicleType::class);
    }
}
