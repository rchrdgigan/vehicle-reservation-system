@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>My Approved List</h4>
            <h6>View your approved booking</h6>
        </div>
    </div>

    <div class="card">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{asset('vendor/img/icons/search-white.svg')}}" alt="img"></a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                    <tr>
                        <th>Images</th>
                        <th>Name/Model</th>
                        <th>Brand</th>
                        <th>Seater</th>
                        <th>Owner</th>
                        <th>Date Pick-up</th>
                        <th>Date Return</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($books->where('status','Approved')->where('user_id',auth()->user()->id) as $book)
                        <tr>
                            <td>
                            @foreach($book->vehicle_img->where('vehicle_id', $book->vehicle_id)->take(1) as $img)
                                <a href="{{route('vehicle.details',  $book->vehicle_id)}}">
                                    <img width="50" src="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" alt="vehicle">
                                </a>
                            @endforeach
                            </td>
                            <td>{{$book->brand_name}}</td>
                            <td>{{$book->vehicle_name. " - " .$book->model_year}}</td>
                            <td>{{$book->seating_cap}}</td>
                            <td>{{$book->owner_name}}.</td>
                            <td>{{Carbon\Carbon::parse($book->date_pickup)->format('M d, Y h:i a')}}</td>
                            <td>{{Carbon\Carbon::parse($book->date_return)->format('M d, Y h:i a')}}</td>
                            <td><a class="bg-success text-white rounded">Approved</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection