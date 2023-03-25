<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'ofname'         => 'required',
            'olname'         => 'required',
            'ocontact'         => 'required',
        ]);

        Owner::create([
            'user_id' => auth()->user()->id,
            'owner_fname' => $request->ofname,
            'owner_lname' => $request->olname,
            'contact' => $request->ocontact,
        ]);
        
        return back()->with('success','Owner successfully setup!');
    }

    public function update(Request $request){
        $validated = $request->validate([
            'ofname'         => 'required',
            'olname'         => 'required',
            'ocontact'         => 'required',
        ]);
        
        $owner = Owner::findOrFail(auth()->user()->owner->id);
        $owner->owner_fname = $request->ofname;
        $owner->owner_lname = $request->olname;
        $owner->contact = $request->ocontact;
        $owner->update();

        return back()->with('success','Owner info successfully update!');
    }
}
