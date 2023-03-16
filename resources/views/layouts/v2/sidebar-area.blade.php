<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{(request()->routeIs('admin.index'))? 'active' : ''}}"><a href="{{route('admin.index')}}"><img src="{{asset('vendor/img/icons/dashboard.svg')}}" alt="img"><span> Dashboard</span> </a></li>
                <li class="submenu">
                    <a href="javascript:void(0);" class="{{(request()->routeIs('admin.vehicle.*'))? 'active' : ''}}"><img src="{{asset('vendor/img/icons/grey-car-steering-wheel.svg')}}" alt="img"><span>Vehicle</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{(request()->routeIs('admin.vehicle.index'))? 'active' : ''}}" href="{{route('admin.vehicle.index')}}">Vehicle List</span></a></li>
                        <li><a class="{{(request()->routeIs('admin.vehicle.create'))? 'active' : ''}}" href="{{route('admin.vehicle.create')}}">Add Vehicle</span></a></li>
                        <li><a href="#">Category Type List</span></a></li>
                        <li><a href="#">Add Category Type</span></a></li>
                        <li><a href="#">Brand List</span></a></li>
                        <li><a href="#">Add Brand</span></a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{asset('vendor/img/icons/users1.svg')}}" alt="img"><span>Customer Booking</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="#">Booking List</a></li>
                        <li><a href="#">Add Customer Booking</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{asset('vendor/img/icons/users1.svg')}}" alt="img"><span> Owners Account</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="#">Owners Account List</a></li>
                        <li><a href="#">Add Owner Account</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>