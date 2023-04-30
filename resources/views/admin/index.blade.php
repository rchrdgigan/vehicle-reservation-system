@extends('layouts.dashboard')

@push('links')
<link rel="stylesheet" href="{{asset('vendor/plugins/select2/css/select2.min.css')}}">
@endpush
@section('content')
<div class="content">
    <div class="row">
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
                    <h4>{{$total_bk_cnt}}</h4>
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
                    <h5 class="card-title mb-0">Vehicle Booking Report <span><a href="{{route('admin.demand.forecast')}}" class="btn btn-primary pl-2"><i data-feather="bar-chart-2"></i> Demand Forecasting</a></span></h5>
                    
                    <div class="graph-sets">
                        <form action="" method="get">
                            <div class="row">
                                <button type="submit" class="btn btn-sm btn-primary">
                                <i data-feather="filter"></i> Filter
                                </button>
                                <select class="form-control form-small select" name="filter">
                                    @if(isset($_GET['filter']))
                                    <option {{($_GET['filter']=='2023')? 'selected':''}}>2023</option>
                                    <option {{($_GET['filter']=='2022')? 'selected':''}}>2022</option>
                                    <option {{($_GET['filter']=='2021')? 'selected':''}}>2021</option>
                                    <option {{($_GET['filter']=='2020')? 'selected':''}}>2020</option>
                                    <option {{($_GET['filter']=='2019')? 'selected':''}}>2019</option>
                                    @else
                                    <option>2023</option>
                                    <option>2022</option>
                                    <option>2021</option>
                                    <option>2020</option>
                                    <option>2019</option>
                                    @endif
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                {!! $chart->container() !!}
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

@push('scripts')

<script src="{{asset('vendor/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('vendor/plugins/select2/js/custom-select.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
{!! $chart->script() !!}
@endpush