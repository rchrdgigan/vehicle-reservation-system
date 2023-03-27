<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Vehicle,Owner,Brand,VehicleImage,Booking};
use App\Charts\BrandChart;
use Carbon\Carbon;
use DB;

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

        if(request('filter')){
            $current_yr = request('filter');
        }else{
            $current_yr = Carbon::parse(Now())->format('Y');
        }

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
        $mar_Completed = Booking::join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
        ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
        ->select(
            DB::raw("brands.brand as brand_name"),
            DB::raw("Count(vehicles.id) as count_v")
        )
        ->groupBy('brands.brand')
        ->where('status','Completed')->where('bookings.updated_at','LIKE', '%'.$current_yr_mar.'%')->get();

        if($mar_Completed->isEmpty()){
            $chart->dataset('No Dataset', 'bar', [$jan_Completed ?? '0', $feb_Completed ?? '0', $mar_dt->count_v ?? '0', $apr_Completed ?? '0', $may_Completed ?? '0', $jun_Completed ?? '0', $jul_Completed ?? '0', $aug_Completed ?? '0', $sept_Completed ?? '0', $oct_Completed ?? '0', $nov_Completed ?? '0', $dec_Completed ?? '0']);
        }else{
            foreach($mar_Completed as $mar_dt){
                $chart->dataset($mar_dt->brand_name, 'bar', [$jan_Completed, $feb_Completed, $mar_dt->count_v, $apr_Completed, $may_Completed, $jun_Completed, $jul_Completed, $aug_Completed, $sept_Completed, $oct_Completed, $nov_Completed, $dec_Completed]);
            }
        }
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
