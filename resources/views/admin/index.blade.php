@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>{{$c_vehicle}}</h4>
                    <h5>Vehicle</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4>{{$c_owner}}</h4>
                    <h5>Owner</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="user-check"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4>0</h4>
                    <h5>Booking</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="file-text"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Vehicle Rent Report</h5>
                    <div class="graph-sets">
                       
                        <div class="dropdown">
                            <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                2022 <img src="{{asset('vendor/img/icons/dropdown.svg')}}" alt="img" class="ms-2">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Recently Added Vehicle</h4>
                    <div class="dropdown">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a href="{{route('admin.vehicle.index')}}" class="dropdown-item">View Vehicle List</a>
                            </li>
                            <li>
                                <a href="{{route('admin.vehicle.create')}}" class="dropdown-item">Vehicle Add</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive dataview">
                        <table class="table datatable ">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Vehicles - Seater</th>
                                <th>Owners</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{Carbon\Carbon::now()->format('y').'-'.str_pad($vehicle->id, 5, '0', STR_PAD_LEFT)}}</td>
                                <td class="productimgname">
                                    <a href="{{route('admin.vehicle.show', $vehicle->id)}}" class="product-img">
                                    @foreach($vehicle_img->where('vehicle_id', $vehicle->id)->take(1) as $img)
                                        <img src="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" alt="vehicle">
                                    @endforeach
                                    </a>
                                    @foreach($brands->where('id', $vehicle->brand_id)->take(1) as $brand)
                                        <a href="">{{ $brand->brand }} - {{ $vehicle->seating_cap }} Seater</a>
                                    @endforeach
                                </td>
                                @foreach($vehicle->assign_vehicle_owner->take(1) as $owner)
                                    @foreach($owners->where('id', $owner->owner_id)->take(1) as $owner)
                                    <td>{{ $owner->owner_fname . " " . $owner->owner_lname[0]}}.</td>
                                    @endforeach
                                @endforeach
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-0">
        <div class="card-body">
            <h4 class="card-title">Expired Vehicles</h4>
            <div class="table-responsive dataview">
                <table class="table datatable ">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Vehicle Plate No.</th>
                        <th>Vehicle Name</th>
                        <th>Brand Name</th>
                        <th>Expiry Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exp_vehicle as $vehicle)
                    <tr>
                        <td>{{Carbon\Carbon::now()->format('y').'-'.str_pad($vehicle->id, 5, '0', STR_PAD_LEFT)}}</td>
                        <td>{{ $vehicle->plate_no }}</td>
                        <td class="productimgname">
                            <a class="product-img" href="{{route('admin.vehicle.show', $vehicle->id)}}">
                                @foreach($vehicle_img->where('vehicle_id', $vehicle->id)->take(1) as $img)
                                    <img src="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" alt="vehicle">
                                @endforeach
                            </a>
                            @foreach($brands->where('id', $vehicle->brand_id)->take(1) as $brand)
                                <a href="">{{ $brand->brand }} - {{ $vehicle->seating_cap }} Seater</a>
                            @endforeach
                        </td>
                        @foreach($brands->where('id', $vehicle->brand_id)->take(1) as $brand)
                        <td>{{ $brand->brand }}</td>
                        @endforeach
                        <td>{{ Carbon\Carbon::parse($vehicle->vehicle_exp)->format('d M Y')}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection