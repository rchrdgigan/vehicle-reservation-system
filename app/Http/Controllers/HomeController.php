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
        $this->middleware(['auth','verified']);
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

    public function adminForecast(){
        for($i = 1; $i <= 5; $i++){
            $current_yr = Carbon::parse(Now())->format('Y');
            $current_yr_jan = Carbon::parse($current_yr - $i.'-01')->format('Y-m');
            $current_yr_feb = Carbon::parse($current_yr - $i.'-02')->format('Y-m');
            $current_yr_mar = Carbon::parse($current_yr - $i.'-03')->format('Y-m');
            $current_yr_apr = Carbon::parse($current_yr - $i.'-04')->format('Y-m');
            $current_yr_may = Carbon::parse($current_yr - $i.'-05')->format('Y-m');
            $current_yr_jun = Carbon::parse($current_yr - $i.'-06')->format('Y-m');
            $current_yr_jul = Carbon::parse($current_yr - $i.'-07')->format('Y-m');
            $current_yr_aug = Carbon::parse($current_yr - $i.'-08')->format('Y-m');
            $current_yr_sept = Carbon::parse($current_yr - $i.'-09')->format('Y-m');
            $current_yr_oct = Carbon::parse($current_yr - $i.'-10')->format('Y-m');
            $current_yr_nov = Carbon::parse($current_yr - $i.'-11')->format('Y-m');
            $current_yr_dev = Carbon::parse($current_yr - $i.'-12')->format('Y-m');
            $rentcount_jan[$i] = Booking::where('updated_at', '%'.$current_yr_jan.'%')->where('status','Completed')->count();
            $rentcount_feb[$i] = Booking::where('updated_at', '%'.$current_yr_feb.'%')->where('status','Completed')->count();
            $rentcount_mar[$i] = Booking::where('updated_at', '%'.$current_yr_mar.'%')->where('status','Completed')->count();
            $rentcount_apr[$i] = Booking::where('updated_at', '%'.$current_yr_apr.'%')->where('status','Completed')->count();
            $rentcount_may[$i] = Booking::where('updated_at', '%'.$current_yr_may.'%')->where('status','Completed')->count();
            $rentcount_jun[$i] = Booking::where('updated_at', '%'.$current_yr_jun.'%')->where('status','Completed')->count();
            $rentcount_jul[$i] = Booking::where('updated_at', '%'.$current_yr_jul.'%')->where('status','Completed')->count();
            $rentcount_aug[$i] = Booking::where('updated_at', '%'.$current_yr_aug.'%')->where('status','Completed')->count();
            $rentcount_sept[$i] = Booking::where('updated_at', '%'.$current_yr_sept.'%')->where('status','Completed')->count();
            $rentcount_oct[$i] = Booking::where('updated_at', '%'.$current_yr_oct.'%')->where('status','Completed')->count();
            $rentcount_nov[$i] = Booking::where('updated_at', '%'.$current_yr_nov.'%')->where('status','Completed')->count();
            $rentcount_dev[$i] = Booking::where('updated_at', '%'.$current_yr_dev.'%')->where('status','Completed')->count();
            $arry = [$rentcount_jan, $rentcount_feb, $rentcount_mar, $rentcount_apr, $rentcount_may, $rentcount_jun, $rentcount_jul, $rentcount_aug, $rentcount_sept, $rentcount_oct, $rentcount_nov, $rentcount_dev];
        }
        $forecast_jan = array_sum($rentcount_jan) / 5; 
        $forecast_feb = array_sum($rentcount_feb) / 5;
        $forecast_mar = array_sum($rentcount_mar) / 5; 
        $forecast_apr = array_sum($rentcount_apr) / 5; 
        $forecast_may = array_sum($rentcount_may) / 5; 
        $forecast_jun = array_sum($rentcount_jun) / 5; 
        $forecast_jul = array_sum($rentcount_jul) / 5; 
        $forecast_aug = array_sum($rentcount_aug) / 5; 
        $forecast_sept = array_sum($rentcount_sept) / 5; 
        $forecast_oct = array_sum($rentcount_oct) / 5; 
        $forecast_nov = array_sum($rentcount_nov) / 5; 
        $forecast_dev = array_sum($rentcount_dev) / 5;
        $chart = new BrandChart;
        $chart->dataset('Predict vehicle renters this year '. $current_yr, 'line', [$forecast_jan, $forecast_feb, $forecast_mar, $forecast_apr, $forecast_may, $forecast_jun, $forecast_jul, $forecast_aug, $forecast_sept, $forecast_oct, $forecast_nov, $forecast_dev]);
        $yr_now = Carbon::parse(Now())->format('Y');
        $x = 1;
        $yr_now_jan = Carbon::parse($yr_now - $x.'-01')->format('Y-m');
        $yr_now_feb = Carbon::parse($yr_now - $x.'-02')->format('Y-m');
        $yr_now_mar = Carbon::parse($yr_now - $x.'-03')->format('Y-m');
        $yr_now_apr = Carbon::parse($yr_now - $x.'-04')->format('Y-m');
        $yr_now_may = Carbon::parse($yr_now - $x.'-05')->format('Y-m');
        $yr_now_jun = Carbon::parse($yr_now - $x.'-06')->format('Y-m');
        $yr_now_jul = Carbon::parse($yr_now - $x.'-07')->format('Y-m');
        $yr_now_aug = Carbon::parse($yr_now - $x.'-08')->format('Y-m');
        $yr_now_sept = Carbon::parse($yr_now - $x.'-09')->format('Y-m');
        $yr_now_oct = Carbon::parse($yr_now - $x.'-10')->format('Y-m');
        $yr_now_nov = Carbon::parse($yr_now - $x.'-11')->format('Y-m');
        $yr_now_dev = Carbon::parse($yr_now - $x.'-12')->format('Y-m');
        $rentcount_janx = Booking::where('updated_at', '%'.$yr_now_jan.'%')->where('status','Completed')->count();
        $rentcount_febx = Booking::where('updated_at', '%'.$yr_now_feb.'%')->where('status','Completed')->count();
        $rentcount_marx = Booking::where('updated_at', '%'.$yr_now_mar.'%')->where('status','Completed')->count();
        $rentcount_aprx = Booking::where('updated_at', '%'.$yr_now_apr.'%')->where('status','Completed')->count();
        $rentcount_mayx = Booking::where('updated_at', '%'.$yr_now_may.'%')->where('status','Completed')->count();
        $rentcount_junx = Booking::where('updated_at', '%'.$yr_now_jun.'%')->where('status','Completed')->count();
        $rentcount_julx = Booking::where('updated_at', '%'.$yr_now_jul.'%')->where('status','Completed')->count();
        $rentcount_augx = Booking::where('updated_at', '%'.$yr_now_aug.'%')->where('status','Completed')->count();
        $rentcount_septx = Booking::where('updated_at', '%'.$yr_now_sept.'%')->where('status','Completed')->count();
        $rentcount_octx = Booking::where('updated_at', '%'.$yr_now_oct.'%')->where('status','Completed')->count();
        $rentcount_novx = Booking::where('updated_at', '%'.$yr_now_nov.'%')->where('status','Completed')->count();
        $rentcount_devx = Booking::where('updated_at', '%'.$yr_now_dev.'%')->where('status','Completed')->count();
        $chart->dataset('Last year vehicle rented', 'bar', [$rentcount_janx, $rentcount_febx, $rentcount_marx, $rentcount_aprx, $rentcount_mayx, $rentcount_junx, $rentcount_julx, $rentcount_augx, $rentcount_septx, $rentcount_octx, $rentcount_novx, $rentcount_devx]);
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

        return view('admin.demand-forecasting',[
            'chart' => $chart
        ]);
    }
}
