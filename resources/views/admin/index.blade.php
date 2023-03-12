@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>0</h4>
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
                    <h4>0</h4>
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
                    <h5>Renters</h5>
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
                                <a href="productlist.html" class="dropdown-item">View Vehicle List</a>
                            </li>
                            <li>
                                <a href="addproduct.html" class="dropdown-item">Vehicle Add</a>
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
                            <tr>
                                <td>1</td>
                                <td class="productimgname">
                                    <a href="" class="product-img">
                                        <img src="{{asset('vendor/img/product/1.jpg')}}" alt="vehicle">
                                    </a>
                                    <a href="">Toyota - 6 Seater</a>
                                </td>
                                <td>User 1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="productimgname">
                                    <a href="" class="product-img">
                                        <img src="{{asset('vendor/img/product/2.jpg')}}" alt="vehicle">
                                    </a>
                                    <a href="">Honda - 4 Seater</a>
                                </td>
                                <td>User 2</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="productimgname">
                                    <a href="" class="product-img">
                                        <img src="{{asset('vendor/img/product/3.jpg')}}" alt="vehicle">
                                    </a>
                                    <a href="">Ford - 4 Seater</a>
                                </td>
                                <td>User 3</td>
                            </tr>
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
                        <th>Category Name</th>
                        <th>Expiry Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td><a href="javascript:void(0);">12345</a></td>
                        <td class="productimgname">
                            <a class="product-img" href="productlist.html">
                                <img src="{{asset('vendor/img/product/1.jpg')}}" alt="vehicle">
                            </a>
                            <a href="productlist.html">Hilux4D - 6 Seater</a>
                        </td>
                        <td>Toyota</td>
                        <td>SUV</td>
                        <td>12-12-2022</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><a href="javascript:void(0);">12345</a></td>
                        <td class="productimgname">
                            <a class="product-img" href="productlist.html">
                                <img src="{{asset('vendor/img/product/2.jpg')}}" alt="vehicle">
                            </a>
                            <a href="productlist.html">Honda Civic - 4 Seater</a>
                        </td>
                        <td>Honda</td>
                        <td>Bridal Car</td>
                        <td>25-11-2022</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><a href="javascript:void(0);">12345</a></td>
                        <td class="productimgname">
                            <a class="product-img" href="productlist.html">
                                <img src="{{asset('vendor/img/product/3.jpg')}}" alt="vehicle">
                            </a>
                            <a href="productlist.html">Fortuner - 6 Seater</a>
                        </td>
                        <td>Ford</td>
                        <td>Party Car</td>
                        <td>19-11-2022</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection