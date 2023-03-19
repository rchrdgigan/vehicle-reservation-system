@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Profile</h4>
            <h6>User Profile</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="profile-set">
                <div class="profile-head">
                </div>
                <div class="profile-top">
                    <div class="profile-content">
                        <div class="profile-contentimg">
                            <img src="{{asset('vendor/img/profiles/avator1.jpg')}}" alt="img" id="blah">
                            <div class="profileupload">
                                <input type="file" id="imgInp">
                                <a href="javascript:void(0);"><img src="{{asset('vendor/img/icons/edit-set.svg')}}" alt="img"></a>
                            </div>
                        </div>
                        <div class="profile-contentname">
                            <h2>{{auth()->user()->fname . " " . auth()->user()->lname}}</h2>
                            <h4>Updates Your Photo and Personal Details.</h4>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" placeholder="Enter Your First Name" name="fname" value="{{auth()->user()->fname}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" placeholder="Enter Your Last Name" name="lname" value="{{auth()->user()->lname}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" placeholder="Enter Your Email" name="email" value="{{auth()->user()->email}}">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" placeholder="Enter Your Cellphone Number" name="cpnumber" value="{{auth()->user()->cpnumber}}">
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" placeholder="Enter Your Address" name="address" value="{{auth()->user()->address}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="javascript:void(0);" class="btn btn-submit me-2">Update</a>
            </div>
        </div>
    </div>
</div>

</div>
@endsection