@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Profile</h4>
            <h6>Admin Profile</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                </div>
            </div>
            <form action="{{route('admin.update.profile')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="profile-set">
                    <div class="profile-head">
                    </div>
                    <div class="profile-top">
                        <div class="profile-content">
                            <div class="profile-contentimg">
                                @if(isset(auth()->user()->image_prof))
                                <img src="{{asset('/storage/user_profile/'. auth()->user()->image_prof)}}" alt="img" id="blah">
                                @else
                                <img src="{{asset('vendor/img/profiles/avator1.jpg')}}" alt="img" id="blah">
                                @endif
                                <div class="profileupload">
                                    <input type="file" id="imgInp" name="image_prof">
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
                            <input type="text" placeholder="Enter Your Email" name="email" value="{{auth()->user()->email}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" 
                                maxlength="11" placeholder="Enter Your Cellphone Number" name="cpnumber" value="{{auth()->user()->cpnumber}}">
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
                    <button type="submit" class="btn btn-submit me-2">Update</button>
                </div>
            </form>
        </div>
        
    </div>
</div>

</div>
@endsection