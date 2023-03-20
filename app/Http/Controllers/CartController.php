<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Brand;
use App\Models\Owner;
use App\Models\User;
use App\Models\Type;
use App\Models\Vehicle;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addCart($vehicle_id,$owner_id){
        $book = Booking::where('user_id', auth()->user()->id)->where('vehicle_id',$vehicle_id)->where('owner_id',$owner_id)->where('status','Cart')->get();
        if($book->isEmpty()){
            $book = Booking::create([
                'user_id'=>auth()->user()->id,
                'vehicle_id'=>$vehicle_id,
                'owner_id'=>$owner_id,
                'status'=>'Cart',
            ]);
            return redirect()->route('cart.list')->with("success","Successfully Added to Cart!");
        }else{
            return redirect()->route('cart.list')->with("error","Car Already Exist to Cart!");
        }
    }

    public function listCart()
    {
        $carts = Booking::get();
        $carts->map(function($item){
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
        $count_cart = Booking::where('status','Cart')->count();
        return view('cart',compact('carts','types','count_cart'));
    }

    public function removeCart(Request $request){
        $book = Booking::findOrFail($request->id);
        $book->delete();
        return redirect()->route('cart.list')->with("success","Vehicle Removed!");;
    }

    public function addBooking($vehicle_id,$owner_id){
        $book = Booking::where('user_id', auth()->user()->id)->where('vehicle_id',$vehicle_id)->where('owner_id',$owner_id)->where('status','Cart')->get();
        if(!$book){
            $book = Booking::create([
                'user_id'=>auth()->user()->id,
                'vehicle_id'=>$vehicle_id,
                'owner_id'=>$owner_id,
                'status'=>'Pending',
            ]);
            return redirect()->route('cart.list')->with("success","Successfully Added to Booking list!");;
        }else{
            $book = Booking::where('user_id', auth()->user()->id)->where('vehicle_id',$vehicle_id)->where('owner_id',$owner_id)->where('status','Cart')->first();
            $book->status = 'Pending';
            $book->update();
            return redirect()->route('cart.list')->with("success","Successfully Added to Booking list!");
        }
    }

    
}
