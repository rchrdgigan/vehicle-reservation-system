<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{(request()->routeIs('admin.index'))? 'active' : ''}}"><a href="{{route('admin.index')}}"><img src="{{asset('vendor/img/icons/dashboard.svg')}}" alt="img"><span> Dashboard</span> </a></li>
                <li class="submenu">
                    <a href="javascript:void(0);" class="{{(request()->routeIs('admin.vehicle.*'))? 'active' : ''}}"><i class="me-2 fa fa-car"></i><span>Vehicle</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{(request()->routeIs('admin.vehicle.index'))? 'active' : ''}}" href="{{route('admin.vehicle.index')}}">Vehicle List</span></a></li>
                        <li><a class="{{(request()->routeIs('admin.vehicle.create'))? 'active' : ''}}" href="{{route('admin.vehicle.create')}}">Add Vehicle</span></a></li>
                        <li><a class="{{(request()->routeIs('admin.vehicle.type.*'))? 'active' : ''}}" href="{{route('admin.vehicle.type.index')}}">Type Management</span></a></li>
                        <li><a class="{{(request()->routeIs('admin.vehicle.brand.*'))? 'active' : ''}}" href="{{route('admin.vehicle.brand.index')}}">Brand Management</span></a></li>
                        <li><a class="{{(request()->routeIs('admin.vehicle.expired'))? 'active' : ''}}" href="{{route('admin.vehicle.expired')}}">Expired Vehicles</span></a></li>
                    </ul>
                </li>
                <li class="{{(request()->routeIs('admin.history.booking.list'))? 'active' : ''}}"><a href="{{route('admin.history.booking.list')}}"><i class="me-2" data-feather="bookmark"></i><span>Booking History</span></a></li>
                
                <li class="{{(request()->routeIs('admin.contact.list'))? 'active' : ''}}"><a href="{{route('admin.contact.list')}}"><i class="me-2" data-feather="bookmark"></i>
                    <span>Contact Messages</span></a></li>

                <li class="{{(request()->routeIs('admin.user.*'))? 'active' : ''}}"><a href="{{route('admin.user.index')}}"><img src="{{asset('vendor/img/icons/users1.svg')}}" alt="img"><span> Users Account List</span> </a></li>
              
            </ul>
        </div>
    </div>
</div>