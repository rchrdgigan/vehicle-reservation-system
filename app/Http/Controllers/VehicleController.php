<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Owner;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\AssignVehicleType;
use Carbon\Carbon;

class VehicleController extends Controller
{
   
    public function index()
    {
        $brands = Brand::get();
        $owners = Owner::get();
        $vehicles = Vehicle::with('assign_vehicle_owner')->where('vehicle_exp', '>' , Carbon::now()->format('Y-m-d'))->get();
        return view('admin.vehicle-list',compact('vehicles','brands','owners'));
    }

   
    public function create()
    {
        $brands = Brand::get();
        $types = Type::get();
        $owners = Owner::get();
        // $dd = Vehicle::with('assign_vehicle_owner')->get();
        return view('admin.add-vehicle',compact('brands','types','owners'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate_no'=>'required',
            'vehicle_exp'=>'required',
            'vehicle_name'=>'required',
            'model_year'=>'required',
            'brand_id'=>'required',
            'seating_cap'=>'required',
            'description'=>'required',
            'owner_id'=>'required',
            'type_id'=>'required',
            'p_photo'=>'required',        
        ]);
        
        $vehicles = Vehicle::create([
            'plate_no' => $request->plate_no,
            'vehicle_exp' => $request->vehicle_exp,
            'vehicle_name' => $request->vehicle_name,
            'model_year' => $request->model_year,
            'brand_id' => $request->brand_id,
            'seating_cap' => $request->seating_cap,
            'description' => $request->description,
            'is_approved' => 'Approved'
        ]);
        if($vehicles){
            $vehicles->assign_vehicle_owner()->create([
                'owner_id' => $request->owner_id,
            ]);
            if(count($validated['type_id'])>0){
                foreach($validated['type_id'] as $type_id){
                    $type_nid = Type::findOrFail($type_id);
                    $vehicles->assign_vehicle_type()->create([
                        'type_id'=>$type_nid->id,
                    ]);
                }
            }        
            if(count($validated['p_photo'])>0){
                foreach($request->file('p_photo') as $p_image){
                    $filenameWithExt = $p_image->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $p_image->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $p_image->storeAs('public/vehicle_image',$fileNameToStore);
                    $vehicles->vehicle_image()->create([
                        'vehicle_img'=>$fileNameToStore,
                    ]);
                }
            }
        }
        return redirect()->route('admin.vehicle.index')->with("success","Successfully Added!");
    }

    
    public function show($id)
    {
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
        return view('admin.show-vehicle',compact('brands','type_name','owner_name','vehicle','vehicle_img'));
    }

    public function changeStatus(Request $request, $id){

    }
    
    public function edit($id)
    {
        $vehicle = Vehicle::with('assign_vehicle_owner')->with('assign_vehicle_type')->findOrFail($id);
        $brands = Brand::get();
        $types = Type::get();
        $owners = Owner::get();
        $vehicle_img = VehicleImage::get();
        return view('admin.edit-vehicle',compact('brands','types','owners','vehicle','vehicle_img'));
    }

  
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'plate_no'=>'required',
            'vehicle_exp'=>'required',
            'vehicle_name'=>'required',
            'model_year'=>'required',
            'brand_id'=>'required',
            'seating_cap'=>'required',
            'description'=>'required',
            'owner_id'=>'required',
            'type_id'=>'required',
            'p_photo'=>'nullable',        
        ]);

        $vehicles = Vehicle::findOrFail($id);

        if($vehicles){
            $vehicles->plate_no = $request->plate_no;
            $vehicles->vehicle_exp = $request->vehicle_exp;
            $vehicles->vehicle_name = $request->vehicle_name;
            $vehicles->model_year = $request->model_year;
            $vehicles->seating_cap = $request->seating_cap;
            $vehicles->description = $request->description;
            $vehicles->update();

            $vehicles->assign_vehicle_owner()->update([
                'owner_id' => $request->owner_id,
            ]);
            AssignVehicleType::where('vehicle_id',$id)->delete();
            if(count($validated['type_id'])>0){
                foreach($validated['type_id'] as $type_id){
                    $type_nid = Type::findOrFail($type_id);
                    $vehicles->assign_vehicle_type()->create([
                        'type_id'=>$type_nid->id,
                    ]);
                }
            } 
            if(isset($validated['p_photo'])){
                if(count($validated['p_photo'])>0){
                    foreach($request->file('p_photo') as $p_image){
                        $filenameWithExt = $p_image->getClientOriginalName();
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension = $p_image->getClientOriginalExtension();
                        $fileNameToStore = $filename.'_'.time().'.'.$extension;
                        $path = $p_image->storeAs('public/vehicle_image',$fileNameToStore);
                        $vehicles->vehicle_image()->create([
                            'vehicle_img'=>$fileNameToStore,
                        ]);
                    }
                }
            }
        }
        return redirect()->route('admin.vehicle.index')->with("success","Successfully Added!");
    }

   
    public function destroy(Request $request)
    {
        $del = Vehicle::findOrFail($request->id);
        if($del){
            $del->delete();
            return redirect()->route('admin.vehicle.index')->with("success","Successfully deleted!");
        }
        return abort(404);
    }
}
