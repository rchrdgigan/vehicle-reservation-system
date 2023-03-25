<div class="header">

    <div class="header-left active" style="overflow:hidden">
        <a href="{{url('/admin/')}}" class="logo mt-2">
            <img src="{{asset('images/vrms-logo.png')}}" alt="">
        </a>
        <a href="{{url('/admin/')}}" class="logo-small mt-2">
            <img src="{{asset('images/vrms-logo.png')}}" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
    <span class="bar-icon">
    <span></span>
    <span></span>
    <span></span>
    </span>
    </a>

    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
            <span class="user-img">
                @if(isset(auth()->user()->image_prof))
                    <img src="{{asset('/storage/user_profile/'. auth()->user()->image_prof)}}" alt="img" id="blah">
                @else
                    <img src="{{asset('vendor/img/profiles/avator1.jpg')}}" alt="img" id="blah">
                @endif
                <span class="status online"></span>
            </span>
            <h6 class="p-2"> Welcome, {{auth()->user()->fname}}</h6>

            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img">
                        @if(isset(auth()->user()->image_prof))
                            <img src="{{asset('/storage/user_profile/'. auth()->user()->image_prof)}}" alt="img" id="blah">
                        @else
                            <img src="{{asset('vendor/img/profiles/avator1.jpg')}}" alt="img" id="blah">
                        @endif
                        <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{auth()->user()->fname . " " . auth()->user()->lname}} </h6>
                            <h5>Admin</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{route('admin.show.profile')}}"> <i class="me-2" data-feather="user"></i> My Profile</a>
                    <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changepassModal">
                        <i class="fa fa-key me-2"></i> Change Password
                    </a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><img src="{{asset('vendor/img/icons/log-out.svg')}}" class="me-2" alt="img">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    
                </div>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">My Profile</a>
            <a class="dropdown-item" href="#">Change Password</a>
            <a class="dropdown-item" href="#">Logout</a>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="changepassModal" tabindex="-1" aria-labelledby="changepassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="form-validation">
                <form action="{{route('admin.update.password')}}" method="post" class="needs-validation">
                @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="changepassModalLabel">Change Password</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label class="col-lg-12 col-form-label" for="validationCustom01">
                                Old Password
                            </label>
                            <div class="col-lg-12">
                                <input type="password" name="old_password" class="form-control" id="validationCustom01" placeholder="Enter your current password.." required="">
                                <div class="invalid-feedback">
                                    Please enter your old password.
                                </div>
                            </div>
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-12 col-form-label" for="validationCustom01">
                                New Password
                            </label>
                            <div class="col-lg-12">
                                <input type="password" name="new_password" class="form-control" id="validationCustom01" placeholder="Enter your new password.." required="">
                                <div class="invalid-feedback">
                                    Please enter your new password.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-12 col-form-label" for="validationCustom01">
                                Confirmation Password
                            </label>
                            <div class="col-lg-12">
                                <input type="password" name="new_password_confirmation" class="form-control" id="validationCustom01" placeholder="Enter your new password.." required="">
                                <div class="invalid-feedback">
                                    Please enter your new password.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>