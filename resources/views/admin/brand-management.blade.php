@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Brand Management</h4>
            <h6>Manage all brand</h6>
        </div>
        <div class="page-btn">
            <a href="" class="btn btn-added"><img src="{{asset('vendor/img/icons/plus.svg')}}" alt="img" class="me-1">Add Vehicles</a>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">

            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{asset('vendor/img/icons/search-white.svg')}}" alt="img"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Reference No">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Completed</option>
                                            <option>Paid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img src="{{asset('vendor/img/icons/search-whites.svg')}}" alt="img"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                            <tr>
                                
                                <th>Date Expired</th>
                                <th>Vehicle Model</th>
                                <th>Vehicle Brand</th>
                                <th>Vehicle Seater</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            <tr>
                                <td>02 Dec 2025</td>
                                <td>Honda Civic - 2018</td>
                                <td>Honda</td>
                                <td>5</td>
                                <td><span class="badges bg-lightgreen">Completed</span></td>
                                <td class="text-center">
                                    <a class="me-3" href="product-details.html">
                                        <img src="{{asset('vendor/img/icons/eye.svg')}}" alt="img">
                                    </a>
                                    <a class="me-3" href="editproduct.html">
                                        <img src="{{asset('vendor/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a class="confirm-text" href="javascript:void(0);">
                                        <img src="{{asset('vendor/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>02 Dec 2025</td>
                                <td>Honda Civic - 2018</td>
                                <td>Honda</td>
                                <td>5</td>
                                <td><span class="badges bg-lightred">Pending</span></td>
                                <td class="text-center">
                                    <a class="me-3" href="product-details.html">
                                        <img src="{{asset('vendor/img/icons/eye.svg')}}" alt="img">
                                    </a>
                                    <a class="me-3" href="editproduct.html">
                                        <img src="{{asset('vendor/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a class="confirm-text" href="javascript:void(0);">
                                        <img src="{{asset('vendor/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                </td>
                            </tr>
                        
                            <tr>
                                <td>02 Dec 2025</td>
                                <td>Honda Civic - 2018</td>
                                <td>Honda</td>
                                <td>5</td>
                                <td><span class="badges bg-lightgreen">Completed</span></td>
                                <td class="text-center">
                                    <a class="me-3" href="product-details.html">
                                        <img src="{{asset('vendor/img/icons/eye.svg')}}" alt="img">
                                    </a>
                                    <a class="me-3" href="editproduct.html">
                                        <img src="{{asset('vendor/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a class="confirm-text" href="javascript:void(0);">
                                        <img src="{{asset('vendor/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                </td>
                            </tr>
                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
   
</div>
@endsection