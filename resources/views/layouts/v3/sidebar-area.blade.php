<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{(request()->routeIs('home'))? 'active' : ''}}"><a href="{{route('home')}}"><img src="{{asset('vendor/img/icons/users1.svg')}}" alt="img"><span> My Account</span> </a></li>
                <hr>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="me-2" data-feather="book"></i><span>My Booking</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{(request()->routeIs('pending.booking'))? 'active' : ''}}" href="{{route('pending.booking')}}">Pending</a></li>
                        <li><a href="#">Approved</a></li>
                        <li><a href="#">Completed</a></li>
                        <li><a class="{{(request()->routeIs('cancelled.booking.list'))? 'active' : ''}}" href="{{route('cancelled.booking.list')}}">Cancelled</a></li>
                    </ul>
                </li>
                <li class="{{(request()->routeIs('history.booking.list'))? 'active' : ''}}"><a href="{{route('history.booking.list')}}"><i class="me-2" data-feather="bookmark"></i><span>Booking History Log</span></a></li>

                @if(auth()->user()->owner)
                <hr>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="me-2 fa fa-car"></i><span>My Car For Rent</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{route('vehicle.create')}}">Add Vehicle</a></li>
                        <li><a href="{{route('vehicle.index')}}">Vehicle List</a></li>
                        <li><a href="{{route('vehicle.expired')}}">Expired Vehicle</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="me-2" data-feather="user"></i><span>My Customer</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="#">Pending</a></li>
                        <li><a href="#">Approved</a></li>
                        <li><a href="#">Completed</a></li>
                        <li><a href="#">Cancelled</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>