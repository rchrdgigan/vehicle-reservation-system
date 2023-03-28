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

        $completed = Booking::join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
        ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
        ->select(
            DB::raw("brands.brand as brand_name"),
            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_jan%' THEN 1
            ELSE 0 END) as jan_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_feb%' THEN 1
            ELSE 0 END) feb_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_mar%' THEN 1
            ELSE 0 END) mar_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_apr%' THEN 1
            ELSE 0 END) apr_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_may%' THEN 1
            ELSE 0 END) may_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_jun%' THEN 1
            ELSE 0 END) jun_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_jul%' THEN 1
            ELSE 0 END) jul_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_aug%' THEN 1
            ELSE 0 END) aug_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_sept%' THEN 1
            ELSE 0 END) sept_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_oct%' THEN 1
            ELSE 0 END) oct_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_nov%' THEN 1
            ELSE 0 END) nov_count_v"),

            DB::raw("SUM(CASE 
            WHEN bookings.updated_at LIKE '$current_yr_dev%' THEN 1
            ELSE 0 END) dev_count_v")
        )
        ->groupBy('brands.brand')
        ->where('status','Completed')->get();
        if($completed->isEmpty()){
            $chart->dataset('No Report to this year '.$current_yr, 'bar', ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0']);
        }else{
            foreach($completed as $dt){
                $chart->dataset($dt->brand_name, 'bar', [$dt->jan_count_v, $dt->feb_count_v, $dt->mar_count_v, $dt->apr_count_v, $dt->may_count_v, $dt->jun_count_v, $dt->jul_count_v, $dt->aug_count_v, $dt->sept_count_v, $dt->oct_count_v, $dt->nov_count_v, $dt->dev_count_v]);
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
