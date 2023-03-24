<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return redirect()->route('home')->with("error", "Old Password Doesn't match!");
        }

        if($request->new_password != $request->new_password_confirmation){
            return redirect()->route('home')->with("error", "Confirmation Password Doesn't match!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('home')->with("success", "Password changed successfully!");
    }
}
