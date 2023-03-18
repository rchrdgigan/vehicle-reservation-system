<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Vehicle,Owner,Brand,VehicleImage};
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome()
    {
        $c_vehicle = Vehicle::where('is_approved','Approved')->where('vehicle_exp', '>' , Carbon::now()->format('Y-m-d'))->count();
        $c_owner = Owner::count();
        $brands = Brand::get();
        $owners = Owner::get();
        $vehicle_img = VehicleImage::get();
        $vehicles = Vehicle::with('assign_vehicle_owner')->paginate(5);
        $exp_vehicle = Vehicle::where('vehicle_exp', '<' , Carbon::now()->format('Y-m-d'))->paginate(5);
        return view('admin.index',compact('c_vehicle','c_owner','brands','owners','vehicles','vehicle_img','exp_vehicle'));
    }

    public function userCart()
    {
        return view('cart');
    }
}
