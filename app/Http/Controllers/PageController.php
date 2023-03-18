<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Vehicle,Brand,Owner,VehicleImage,Type};
use Carbon\Carbon;

class PageController extends Controller
{
    public function welcome(){
        $brands = Brand::get();
        $owners = Owner::get();
        $vehicle_img = VehicleImage::get();
        $vehicles = Vehicle::where('is_approved','Approved')->where('vehicle_exp', '>' , Carbon::now()->format('Y-m-d'))->get();
        
        return view('welcome',compact('vehicles','brands','owners','vehicle_img'));
    }

    public function vehicleDetail($id){
        $vehicle = Vehicle::with('assign_vehicle_owner')->with('assign_vehicle_type')->findOrFail($id);
        foreach($vehicle->assign_vehicle_owner->take(1) as $assign_owner){
            $owner = Owner::findOrFail($assign_owner->owner_id);
            $owner_name = $owner->owner_fname . " " . $owner->owner_lname;
        }
        foreach($vehicle->assign_vehicle_type as $assign_type){
            $type = Type::findOrFail($assign_type->type_id);
            $type_name[] = $type->type;
        }
        $brands = Brand::findOrFail($vehicle->brand_id);
        $vehicle_img = VehicleImage::get();
        $owners = Owner::get();
        $o_t_brand = Vehicle::where('brand_id',$vehicle->brand_id)->where('is_approved','Approved')->where('vehicle_exp', '>' , Carbon::now()->format('Y-m-d'))->get();
        return view('vehicle-details',compact('brands','type_name','owner_name','vehicle','vehicle_img','o_t_brand','owners'));
    }

    public function vehicleList(){
        $brands = Brand::get();
        $owners = Owner::get();
        $vehicle_img = VehicleImage::get();
        $vehicles = Vehicle::where('is_approved','Approved')->where('vehicle_exp', '>' , Carbon::now()->format('Y-m-d'))->get();
        
        return view('vehicle-list',compact('vehicles','brands','owners','vehicle_img'));
    }

    public function ownerCars(){
        return view('owner-of-car');
    }

}
