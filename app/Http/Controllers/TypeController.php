<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::get();
        return view('admin.type-management', compact('types'));
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
            'type'         => 'required',
        ]);

        $type = Type::create(['type'=>$request->type]);
        if($type){
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
        $edit_type = Type::findOrFail($id);
        $types = Type::get();
        return view('admin.edit-type', compact('types','edit_type'));
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
            'type'         => 'required',
        ]);

        $edit_type = Type::findOrFail($id);
        if($edit_type){
            $edit_type->type = $request->type;
            $edit_type->update();
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
        $del_type = Type::findOrFail($request->id);
        if($del_type){
            $del_type->delete();
            return redirect()->route('admin.vehicle.type.index')->with("success","Successfully deleted!");
        }
        return abort(404);
    }
}
