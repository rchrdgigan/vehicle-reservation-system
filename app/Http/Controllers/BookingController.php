<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Brand;
use App\Models\Owner;
use App\Models\User;
use App\Models\Type;
use App\Models\Vehicle;
use App\Models\AssignVehicleOwner;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(){
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
        return view('pending-booking',compact('books','types'));
    }

    public function addBookingFromCart($id,$vehicle_id,$owner_id){
        $owner_vehicle = AssignVehicleOwner::where('owner_id', auth()->user()->owner->id ?? '')->where('vehicle_id', $vehicle_id)->get();
        if($owner_vehicle->isEmpty()){
            $book = Booking::where('user_id', auth()->user()->id)->where('vehicle_id',$vehicle_id)->where('owner_id',$owner_id)->where('status','Pending')->get();
            if($book->isEmpty()){
                $booking = Booking::findOrFail($id);
                $booking->status = 'Pending';
                $booking->update();
                return redirect()->route('pending.booking')->with("success","Successfully Added to booking pending list!");
            }else{
                return redirect()->route('pending.booking')->with("error","Vehicle already exist in booking pending list! Waiting for approval of owner.");
            }
        }else{
            return redirect()->back()->with("error","You cannot add booking your owned vehicle!");
        }
        
    }

    public function addBooking(Request $request,$vehicle_id,$owner_id){
        $owner_vehicle = AssignVehicleOwner::where('owner_id', auth()->user()->owner->id ?? '')->where('vehicle_id', $vehicle_id)->get();
        if($owner_vehicle->isEmpty()){
            $book = Booking::where('user_id', auth()->user()->id)->where('vehicle_id',$vehicle_id)->where('owner_id',$owner_id)->where('status','Pending')->get();
            if($book->isEmpty()){
                Booking::create([
                    'user_id'=>auth()->user()->id,
                    'vehicle_id'=>$vehicle_id,
                    'owner_id'=>$owner_id,
                    'date_pickup'=>$request->dtpickup,
                    'date_return'=>$request->dtreturn,
                    'status'=>'Pending',
                ]);
                return redirect()->route('pending.booking')->with("success","Successfully Added to booking pending list!");
            }else{
                return redirect()->route('pending.booking')->with("error","Vehicle already exist in booking pending list! Waiting for approval of owner.");
            }
        }else{
            return redirect()->back()->with("error","You cannot booking your owned vehicle!");
        }
    }

    public function addBookingModal(Request $request){
        $owner_vehicle = AssignVehicleOwner::where('owner_id', auth()->user()->owner->id ?? '')->where('vehicle_id', $request->vehicle_id)->get();
        if($owner_vehicle->isEmpty()){
            $book = Booking::where('user_id', auth()->user()->id)->where('vehicle_id',$request->vehicle_id)->where('owner_id',$request->owner_id)->where('status','Pending')->get();
            if($book->isEmpty()){
                Booking::create([
                    'user_id'=>auth()->user()->id,
                    'vehicle_id'=>$request->vehicle_id,
                    'owner_id'=>$request->owner_id,
                    'date_pickup'=>$request->dtpickup,
                    'date_return'=>$request->dtreturn,
                    'status'=>'Pending',
                ]);
                return redirect()->route('pending.booking')->with("success","Successfully Added to booking pending list!");
            }else{
                return redirect()->route('pending.booking')->with("error","Vehicle already exist in booking pending list! Waiting for approval of owner.");
            }
        }else{
            return redirect()->back()->with("error","You cannot booking your owned vehicle!");
        }
    }

    public function cancelledBookingList(){
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
        return view('cancelled-booking',compact('books','types'));
    }

    public function cancelledBooking(Request $request){
        $booking = Booking::findOrFail( $request->id );
        $booking->status = 'Cancelled';
        $booking->update();
        if(request()->routeIs('owner.index')){
            return redirect()->route('cancel.customer.list')->with("success","Successfully cancelled booking!");
        }else{
            return redirect()->route('cancel.booking')->with("success","Successfully cancelled booking!");
        }
    }

    public function historyBookingList(){
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
        return view('booking-history',compact('books','types'));
    }

    public function approveBookingList(){
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
        return view('approved-booking',compact('books','types'));
    }

    public function doneBookingList(){
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
        return view('complete-booking',compact('books','types'));
    }

}
