<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function showProfile(){
        return view('admin.profile');
    }
    public function updateProfile(Request $request){

        $validated = $request->validate([
            'fname'         => 'required',
            'lname'         => 'required',
            'email'         => 'required|email',
            'cpnumber'         => 'required',
            'address'         => 'required',
            'image_prof'         => 'nullable',
        ]);

        if($request->hasFile('image_prof'))
        {
            $filenameWithExt = $request->file('image_prof')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_prof')->getClientOriginalExtension();
            $fileToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image_prof')->storeAs('public/user_profile/',$fileToStore);
        }

        $user = User::findOrFail(auth()->user()->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->cpnumber = $request->cpnumber;
        $user->address = $request->address;
        if(isset($fileToStore)){
            $user->image_prof = $fileToStore;
        }
        $user->update();

        return back()->with("success","Successfully updated!");
    }
}
