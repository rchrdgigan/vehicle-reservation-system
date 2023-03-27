<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Vehicle,Owner,Brand,VehicleImage,Booking};
use App\Charts\BrandChart;
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
        $booking_approved = Booking::where('status', 'Approved')->count();
        $booking_done = Booking::where('status', 'Completed')->count();
        $vehicle_img = VehicleImage::get();
        $vehicles = Vehicle::with('assign_vehicle_owner')->paginate(5);
        $exp_vehicle = Vehicle::where('vehicle_exp', '<' , Carbon::now()->format('Y-m-d'))->latest(5);
        $total_bk_cnt = $booking_approved + $booking_done;

        $chart = new BrandChart;
        $current_yr = Carbon::parse(Now())->format('Y');
        $current_yr_jan = Carbon::parse($current_yr.'-01')->format('Y-m');
        $current_yr_feb = Carbon::parse($current_yr.'-02')->format('Y-m');
        $current_yr_mar = Carbon::parse($current_yr.'-03')->format('Y-m');
        $current_yr_apr = Carbon::parse($current_yr.'-04')->format('Y-m');
        $current_yr_may = Carbon::parse($current_yr.'-05')->format('Y-m');
        $current_yr_jun = Carbon::parse($current_yr.'-06')->format('Y-m');
        $current_yr_jul = Carbon::parse($current_yr.'-07')->format('Y-m');
        $current_yr_aug = Carbon::parse($current_yr.'-08')->format('Y-m');
        $current_yr_sept = Carbon::parse($current_yr.'-09')->format('Y-m');
        $current_yr_oct = Carbon::parse($current_yr.'-10')->format('Y-m');
        $current_yr_nov = Carbon::parse($current_yr.'-11')->format('Y-m');
        $current_yr_dev = Carbon::parse($current_yr.'-12')->format('Y-m');

        $jan_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_jan.'%')->count();
        $feb_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_feb.'%')->count();
        $mar_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_mar.'%')->count();
        $apr_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_apr.'%')->count();
        $may_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_may.'%')->count();
        $jun_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_jun.'%')->count();
        $jul_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_jul.'%')->count();
        $aug_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_aug.'%')->count();
        $sept_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_sept.'%')->count();
        $oct_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_oct.'%'.'%')->count();
        $nov_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_nov.'%')->count();
        $dec_Completed = Booking::with('vehicle')->where('status','Completed')->where('updated_at','LIKE', '%'.$current_yr_dev.'%')->count();
        $chart->dataset('Completed', 'bar', [$jan_Completed, $feb_Completed, $mar_Completed, $apr_Completed, $may_Completed, $jun_Completed, $jul_Completed, $aug_Completed, $sept_Completed, $oct_Completed, $nov_Completed, $dec_Completed]);

        $jan_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_jan.'%')->count();
        $feb_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_feb.'%')->count();
        $mar_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_mar.'%')->count();
        $apr_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_apr.'%')->count();
        $may_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_may.'%')->count();
        $jun_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_jun.'%')->count();
        $jul_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_jul.'%')->count();
        $aug_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_aug.'%')->count();
        $sept_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_sept.'%')->count();
        $oct_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_oct.'%'.'%')->count();
        $nov_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_nov.'%')->count();
        $dec_Pending = Booking::with('vehicle')->where('status','Pending')->where('updated_at','LIKE', '%'.$current_yr_dev.'%')->count();
        $chart->dataset('Pending', 'bar', [$jan_Pending, $feb_Pending, $mar_Pending, $apr_Pending, $may_Pending, $jun_Pending, $jul_Pending, $aug_Pending, $sept_Pending, $oct_Pending, $nov_Pending, $dec_Pending]);
        
        $jan_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_jan.'%')->count();
        $feb_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_feb.'%')->count();
        $mar_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_mar.'%')->count();
        $apr_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_apr.'%')->count();
        $may_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_may.'%')->count();
        $jun_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_jun.'%')->count();
        $jul_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_jul.'%')->count();
        $aug_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_aug.'%')->count();
        $sept_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_sept.'%')->count();
        $oct_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_oct.'%'.'%')->count();
        $nov_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_nov.'%')->count();
        $dec_Approved = Booking::with('vehicle')->where('status','Approved')->where('updated_at','LIKE', '%'.$current_yr_dev.'%')->count();
        $chart->dataset('Approved', 'bar', [$jan_Approved, $feb_Approved, $mar_Approved, $apr_Approved, $may_Approved, $jun_Approved, $jul_Approved, $aug_Approved, $sept_Approved, $oct_Approved, $nov_Approved, $dec_Approved]);
        
        $jan_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_jan.'%')->count();
        $feb_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_feb.'%')->count();
        $mar_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_mar.'%')->count();
        $apr_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_apr.'%')->count();
        $may_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_may.'%')->count();
        $jun_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_jun.'%')->count();
        $jul_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_jul.'%')->count();
        $aug_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_aug.'%')->count();
        $sept_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_sept.'%')->count();
        $oct_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_oct.'%'.'%')->count();
        $nov_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_nov.'%')->count();
        $dec_Cancelled = Booking::with('vehicle')->where('status','Cancelled')->where('updated_at','LIKE', '%'.$current_yr_dev.'%')->count();
        $chart->dataset('Cancelled', 'bar', [$jan_Cancelled, $feb_Cancelled, $mar_Cancelled, $apr_Cancelled, $may_Cancelled, $jun_Cancelled, $jul_Cancelled, $aug_Cancelled, $sept_Cancelled, $oct_Cancelled, $nov_Cancelled, $dec_Cancelled]);
        
        $chart->labels([
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sept",
            "Oct",
            "Nov",
            "Dec",
        ]);

        return view('admin.index',compact('c_vehicle','c_owner','brands','owners','vehicles','vehicle_img','exp_vehicle','total_bk_cnt','chart'));
    }
}
