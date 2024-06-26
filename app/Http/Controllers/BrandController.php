<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::get();
        return view('admin.brand-management', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand'         => 'required',
        ]);

        $brand = Brand::create(['brand'=>$request->brand]);
        if($brand){
            return back()->with("success","Successfully Added!");
        }else{
            return back()->with("error","Opps Something Wrong!");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_brand = Brand::findOrFail($id);
        $brands = Brand::get();
        return view('admin.edit-brand', compact('brands','edit_brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand'         => 'required',
        ]);

        $edit_brand = Brand::findOrFail($id);
        if($edit_brand){
            $edit_brand->brand = $request->brand;
            $edit_brand->update();
            return back()->with("success","Successfully updated!");
        }
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $del_brand = Brand::findOrFail($request->id);
        if($del_brand){
            $del_brand->delete();
            return redirect()->route('admin.vehicle.brand.index')->with("success","Successfully deleted!");
        }
        return abort(404);
    }
}
