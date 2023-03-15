<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function vehicleList(){
        return view('vehicle-list');
    }

    public function vehicleDetail(){
        return view('vehicle-details');
    }

    public function ownerCars(){
        return view('owner-of-car');
    }

}
