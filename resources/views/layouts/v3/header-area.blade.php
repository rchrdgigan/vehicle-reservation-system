<div class="header">

    <div class="header-left active" style="overflow:hidden">
        <a href="{{url('/')}}" class="logo mt-2">
            <img src="{{asset('images/vrms-logo.png')}}" alt="">
        </a>
        <a href="{{url('/')}}" class="logo-small mt-2">
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
            <span class="user-img"><img src="{{asset('vendor/img/profiles/avator1.jpg')}}" alt="">
            <span class="status online"></span></span>
            <h6 class="p-2">{{auth()->user()->fname}}</h6>

            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="{{asset('vendor/img/profiles/avator1.jpg')}}" alt="">
                        <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{auth()->user()->fname . " " . auth()->user()->lname}} </h6>
                            <h5>Account</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="#"> <i class="me-2" data-feather="settings"></i>Change Password</a>
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
            <a class="dropdown-item" href="#">My Account</a>
            <a class="dropdown-item" href="#">Logout</a>
        </div>
    </div>

</div>