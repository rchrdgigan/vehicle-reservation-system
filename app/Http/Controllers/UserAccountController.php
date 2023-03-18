<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Owner;

class UserAccountController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('owner')->get();
        return view('admin.user-account', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'owner_fname'         => 'required',
            'owner_lname'         => 'required',
            'contact'         => 'required',
        ]);

        $users = User::findOrFail($id); 
        $owner = Owner::create([
            'user_id'=>$users->id,
            'owner_fname'=>$request->owner_fname,
            'owner_lname'=>$request->owner_lname,
            'contact'=>$request->contact,
        ]);

        if($owner){
            return redirect()->route('admin.user.index')->with("success","Successfully Added!");
        }else{
            return redirect()->route('admin.user.index')->with("error","Opps Something Wrong!");
        }
    }

    public function create($id)
    {
        $users = User::findOrFail($id);
        return view('admin.add-owner-user', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_owner = Owner::findOrFail($id);
        $users = User::findOrFail($edit_owner->user_id);
        return view('admin.edit-owner-user', compact('users','edit_owner'));
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
            'owner_fname'         => 'required',
            'owner_lname'         => 'required',
            'contact'         => 'required',
        ]);

        $edit_owner = Owner::findOrFail($id);
        if($edit_owner){
            $edit_owner->owner_fname = $request->owner_fname;
            $edit_owner->owner_lname = $request->owner_lname;
            $edit_owner->contact = $request->contact;
            $edit_owner->update();
            return redirect()->route('admin.user.index')->with("success","Successfully updated!");
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
        $del_user = user::findOrFail($request->id);
        if($del_user){
            $del_user->delete();
            return redirect()->route('admin.vehicle.user.index')->with("success","Successfully deleted!");
        }
        return abort(404);
    }
}
