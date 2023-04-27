<header>
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="header-top-left">
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="header-top-right">
                        <ul class="ht-menu">
                        @guest
                            @if (Route::has('login'))
                            <li>
                                <div><span><a href="{{ route('login') }}">{{ __('Login') }}</a></span></div>
                            </li>
                            @endif
                            @if (Route::has('register'))
                            <li>
                                <div><span><a href="{{ route('register') }}">{{ __('Register') }}</a></span></div>
                            </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle"></i> Welcome, {{ Auth::user()->fname }}
                            </a>
                            @if(auth()->user()->is_admin != '1')
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item btn-secondary" href="{{route('home')}}">
                                    <i class="fa fa-user"></i> {{ __('My Account') }}
                                </a>
                                <a class="dropdown-item btn-secondary" href="{{route('pending.booking')}}">
                                    <i class="fa fa-book"></i> {{ __('My Booking') }}
                                </a>
                                @if(auth()->user()->owner)
                                <a class="dropdown-item btn-secondary" href="{{route('vehicle.index')}}">
                                    <i class="fa fa-car"></i> {{ __('My Car For Rent') }}
                                </a>
                                @endif
                                <a class="dropdown-item text-danger btn-secondary" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                   <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            @else
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item btn-secondary" href="{{route('admin.index')}}">
                                    <i class="fa fa-tachometer"></i> {{ __('Dashboard') }}
                                </a>
                                <a class="dropdown-item btn-secondary" href="{{route('admin.show.profile')}}">
                                    <i class="fa fa-user"></i> {{ __('My Profile') }}
                                </a>
                                <a class="dropdown-item text-danger btn-secondary" href="#"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                   <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>  
                            @endif
                        </li>
                        @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="{{url('/')}}">
                            <img src="{{asset('images/vrms-logo.png')}}" alt="" height="50">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <form action="{{route('vehicle.search')}}" method="GET" class="hm-searchbox">
                        <input type="text" name="search" placeholder="Enter your search key ...">
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <li class="hm-wishlist">
                                <a href="{{route('cart.list')}}">
                                @guest
                                    <span class="cart-item-count wishlist-item-count">0</span>
                                    <span class="item-icon"></span>
                                @else
                                    <span class="cart-item-count wishlist-item-count">{{$count_cart}}</span>
                                    <span class="item-icon"></span>
                                @endguest
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom mb-0 header-sticky stick d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hb-menu">
                        <nav>
                            <ul>
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li><a href="{{route('about')}}">About Us</a></li>
                                <li><a href="{{route('contact.index')}}">Contact Us</a></li>
                                <li><a href="{{route('vehicle.list')}}">Vehicle List</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container"> 
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
</header>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
        <strong>Success!</strong> {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
        <strong>Warning!</strong> {{ session('error') }}
    </div>
@endif