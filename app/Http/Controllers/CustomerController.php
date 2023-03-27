<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Booking,Vehicle,Brand,Owner,Type,User};

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Booking::get();
        $books->map(function($item){
            $user = User::findOrFail($item->user_id);
            $item->name = $user->fname . " " . $user->lname;
            $item->address = $user->address;
            $item->cpnumber = $user->cpnumber;
            $vehicle = Vehicle::with('vehicle_image')->with('assign_vehicle_type')->findOrFail($item->vehicle_id);
            $item->plate_no = $vehicle->plate_no;
            $item->vehicle_exp = $vehicle->vehicle_exp;
            $item->vehicle_name = $vehicle->vehicle_name;
            $item->model_year = $vehicle->model_year;
            $item->seating_cap = $vehicle->seating_cap;
            $item->description = $vehicle->description;
            $item->is_approved = $vehicle->is_approved;
            $item->vehicle_type = $vehicle->assign_vehicle_type;
            $item->vehicle_img = $vehicle->vehicle_image;
            $brand = Brand::findOrFail($vehicle->brand_id);
            $item->brand_name = $brand->brand;
            $owner = Owner::findOrFail($item->owner_id);
            $item->owner_name = $owner->owner_fname . " " . $owner->owner_lname[0];
            $item->contact = $owner->contact;
        });
        $types = Type::get();
        return view('my-pending-customer',compact('books','types'));
    }

    public function cancelledCustomerList(){
        $books = Booking::get();
        $books->map(function($item){
            $user = User::findOrFail($item->user_id);
            $item->name = $user->fname . " " . $user->lname;
            $item->address = $user->address;
            $item->cpnumber = $user->cpnumber;
            $vehicle = Vehicle::with('vehicle_image')->with('assign_vehicle_type')->findOrFail($item->vehicle_id);
            $item->plate_no = $vehicle->plate_no;
            $item->vehicle_exp = $vehicle->vehicle_exp;
            $item->vehicle_name = $vehicle->vehicle_name;
            $item->model_year = $vehicle->model_year;
            $item->seating_cap = $vehicle->seating_cap;
            $item->description = $vehicle->description;
            $item->is_approved = $vehicle->is_approved;
            $item->vehicle_type = $vehicle->assign_vehicle_type;
            $item->vehicle_img = $vehicle->vehicle_image;
            $brand = Brand::findOrFail($vehicle->brand_id);
            $item->brand_name = $brand->brand;
            $owner = Owner::findOrFail($item->owner_id);
            $item->owner_name = $owner->owner_fname . " " . $owner->owner_lname[0];
            $item->contact = $owner->contact;
        });
        $types = Type::get();
        return view('customer-cancelled',compact('books','types'));
    }

    public function cancelledCustomer(Request $request){
        $booking = Booking::findOrFail( $request->id );
        $booking->status = 'Cancelled';
        $booking->update();
        return redirect()->route('cancel.customer')->with("success","Successfully cancelled customer!");
    }

    public function approvedCustomerList(){
        $books = Booking::get();
        $books->map(function($item){
            $user = User::findOrFail($item->user_id);
            $item->name = $user->fname . " " . $user->lname;
            $item->address = $user->address;
            $item->cpnumber = $user->cpnumber;
            $vehicle = Vehicle::with('vehicle_image')->with('assign_vehicle_type')->findOrFail($item->vehicle_id);
            $item->plate_no = $vehicle->plate_no;
            $item->vehicle_exp = $vehicle->vehicle_exp;
            $item->vehicle_name = $vehicle->vehicle_name;
            $item->model_year = $vehicle->model_year;
            $item->seating_cap = $vehicle->seating_cap;
            $item->description = $vehicle->description;
            $item->is_approved = $vehicle->is_approved;
            $item->vehicle_type = $vehicle->assign_vehicle_type;
            $item->vehicle_img = $vehicle->vehicle_image;
            $brand = Brand::findOrFail($vehicle->brand_id);
            $item->brand_name = $brand->brand;
            $owner = Owner::findOrFail($item->owner_id);
            $item->owner_name = $owner->owner_fname . " " . $owner->owner_lname[0];
            $item->contact = $owner->contact;
        });
        $types = Type::get();
        return view('customer-approved',compact('books','types'));
    }

    public function approvedCustomer(Request $request){
        $booking = Booking::findOrFail( $request->id );
        $booking->status = 'Approved';
        $booking->update();

        $vehicle = Vehicle::findOrFail($booking->vehicle_id);
        $vehicle->is_approved = 'Not Available';
        $vehicle->update();

        return redirect()->route('approved.customer')->with("success","Successfully approved customer!");
    }
    
    public function doneCustomerList(){
        $books = Booking::get();
        $books->map(function($item){
            $user = User::findOrFail($item->user_id);
            $item->name = $user->fname . " " . $user->lname;
            $item->address = $user->address;
            $item->cpnumber = $user->cpnumber;
            $vehicle = Vehicle::with('vehicle_image')->with('assign_vehicle_type')->findOrFail($item->vehicle_id);
            $item->plate_no = $vehicle->plate_no;
            $item->vehicle_exp = $vehicle->vehicle_exp;
            $item->vehicle_name = $vehicle->vehicle_name;
            $item->model_year = $vehicle->model_year;
            $item->seating_cap = $vehicle->seating_cap;
            $item->description = $vehicle->description;
            $item->is_approved = $vehicle->is_approved;
            $item->vehicle_type = $vehicle->assign_vehicle_type;
            $item->vehicle_img = $vehicle->vehicle_image;
            $brand = Brand::findOrFail($vehicle->brand_id);
            $item->brand_name = $brand->brand;
            $owner = Owner::findOrFail($item->owner_id);
            $item->owner_name = $owner->owner_fname . " " . $owner->owner_lname[0];
            $item->contact = $owner->contact;
        });
        $types = Type::get();
        return view('customer-completed',compact('books','types'));
    }

    public function doneCustomer(Request $request){
        $booking = Booking::findOrFail( $request->id );
        $booking->status = 'Completed';
        $booking->update();

        $vehicle = Vehicle::findOrFail($booking->vehicle_id);
        $vehicle->is_approved = 'Approved';
        $vehicle->update();

        return redirect()->route('done.customer')->with("success","Successfully done the customer transaction!");
    }

}
