<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignVehicleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'type_id'
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

}
