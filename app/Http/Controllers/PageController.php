<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Vehicle,Brand,Owner,VehicleImage,Type,AssignVehicleType,Booking};
use Carbon\Carbon;

class PageController extends Controller
{
    public function welcome(){
        $brands = Brand::get();
        $owners = Owner::get();
        $vehicle_img = VehicleImage::get();
        $vehicles = Vehicle::where('is_approved','Approved')->where('vehicle_exp', '>' , Carbon::now()->format('Y-m-d'))->get();
        $count_cart = Booking::where('status','Cart')->count();
        return view('welcome',compact('vehicles','brands','owners','vehicle_img','count_cart'));
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
        $count_cart = Booking::where('status','Cart')->count();
        return view('vehicle-details',compact('brands','type_name','owner_name','vehicle','vehicle_img','o_t_brand','owners','owner','count_cart'));
    }

    public function vehicleList(){
        $vehicles = Vehicle::where('is_approved','Approved')->where('vehicle_exp', '>' , Carbon::now()->format('Y-m-d'))->get();
        $types = Type::with('assign_vehicle_type')->get();
        $brands = Brand::with('vehicle')->get();
        $owners = Owner::get();
        $vehicle_img = VehicleImage::get();
        $vehicle_type = AssignVehicleType::with('vehicle')->get();
        $count_cart = Booking::where('status','Cart')->count();
        return view('vehicle-list',compact('vehicles','brands','owners','vehicle_img','vehicle_type','types','count_cart'));
    }

    public function vehicleFilteredBrand($id){
        $vehicles = Vehicle::where('brand_id', $id)->where('is_approved','Approved')->where('vehicle_exp', '>' , Carbon::now()->format('Y-m-d'))->get();
        $types = Type::with('assign_vehicle_type')->get();
        $brands = Brand::with('vehicle')->get();
        $owners = Owner::get();
        $vehicle_img = VehicleImage::get();
        $vehicle_type = AssignVehicleType::with('vehicle')->get();
        $count_cart = Booking::where('status','Cart')->count();
        return view('vehicle-list',compact('vehicles','brands','owners','vehicle_img','vehicle_type','types','count_cart'));
    }

    public function vehicleFilteredType($id){
        $vehicles = AssignVehicleType::where('type_id', $id)->get();
        $vehicles->map(function($item){
            $v_type = Vehicle::with('assign_vehicle_owner')->findOrFail($item->vehicle_id);
            $item->id = $v_type->id;
            $item->plate_no = $v_type->plate_no;
            $item->vehicle_exp = $v_type->vehicle_exp;
            $item->vehicle_name = $v_type->vehicle_name;
            $item->model_year = $v_type->model_year;
            $item->brand_id = $v_type->brand_id;
            $item->seating_cap = $v_type->seating_cap;
            $item->description = $v_type->description;
            $item->is_approved = $v_type->is_approved;
            $item->created_at = $v_type->created_at;
            $item->updated_at = $v_type->updated_at;
            $item->assign_vehicle_owner = $v_type->assign_vehicle_owner;
            $item->assign_vehicle_owner->map(function($itemOwner){
                $v_owners = Owner::findOrFail($itemOwner->owner_id);
                $itemOwner->user_id = $v_owners->user_id;
                $itemOwner->owner_fname = $v_owners->owner_fname;
                $itemOwner->owner_lname = $v_owners->owner_lname;
                $itemOwner->contact = $v_owners->contact;
            });
        });
        $types = Type::with('assign_vehicle_type')->get();
        $brands = Brand::with('vehicle')->get();
        $owners = Owner::get();
        $vehicle_img = VehicleImage::get();
        $vehicle_type = AssignVehicleType::with('vehicle')->get();
        $count_cart = Booking::where('status','Cart')->count();
        return view('vehicle-list',compact('vehicles','brands','owners','vehicle_img','vehicle_type','types','count_cart'));
    }

    public function ownerCars(){
        return view('owner-of-car');
    }

}
