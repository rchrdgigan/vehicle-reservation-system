<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Brand;
use App\Models\Owner;
use App\Models\Vehicle;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addCart($vehicle_id,$owner_id){
        $book = Booking::where('user_id', auth()->user()->id)->where('vehicle_id',$vehicle_id)->where('owner_id',$owner_id)->where('status','Cart')->get();
        if(!$book){
            $book = Booking::create([
                'user_id'=>auth()->user()->id,
                'vehicle_id'=>$vehicle_id,
                'owner_id'=>$owner_id,
                'status'=>'Cart',
            ]);
            return redirect()->route('cart.list')->with("success","Successfully Added to Cart!");;
        }else{
            return redirect()->route('cart.list')->with("error","Car Already Exist to Cart!");;
        }
    }

    public function listCart()
    {
        $brands = Brand::get();
        $owners = Owner::get();
        $vehicles = Vehicle::with('assign_vehicle_owner')->where('vehicle_exp', '>' , Carbon::now()->format('Y-m-d'))->get();
        return view('cart',compact('vehicles','brands','owners'));
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
            return redirect()->route('cart.list')->with("success","uccessfully Added to Booking list!");
        }
    }
}
