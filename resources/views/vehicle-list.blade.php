@extends('layouts.app')

@section('title')
Vehicle List |
@endsection

@section('breadcrumbs')
List of Vehicle
@endsection

@section('content')
<div class="content-wraper pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="shop-top-bar">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i> Vehicle List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">

                                    <div class="col-lg-4 col-md-4 col-sm-4 mt-40">
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{route('vehicle.details')}}">
                                                    <img height="250" src="{{asset('images/na/car-not-avail.jpg')}}">
                                                </a>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                        <a><span class="product-details-ref">Brand:</span> Toyota</a><br>
                                                        <a><span class="product-details-ref">Model:</span> Innova - 2018</a><br>
                                                        <a><span class="product-details-ref">Seater:</span> 6</a><br>
                                                        <a><span class="product-details-ref">Booking Type:</span> Bridal Car, Sports Car, Party Car</a><br>
                                                        </h5>
                                                    </div>
                                                    <h4><a class="product_name" href="">Owner Name</a></h4>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                        <li><a href="{{route('vehicle.details')}}" class="quick-view-btn"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4 mt-40">
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="#">
                                                    <img height="250" src="{{asset('images/na/car-not-avail.jpg')}}">
                                                </a>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                        <a><span class="product-details-ref">Brand:</span> Toyota</a><br>
                                                        <a><span class="product-details-ref">Model:</span> Innova - 2018</a><br>
                                                        <a><span class="product-details-ref">Seater:</span> 6</a><br>
                                                        <a><span class="product-details-ref">Booking Type:</span> Bridal Car, Sports Car, Party Car</a><br>
                                                        </h5>
                                                    </div>
                                                    <h4><a class="product_name" href="">Owner Name</a></h4>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                        <li><a href="{{route('vehicle.details')}}" class="quick-view-btn"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="paginatoin-area mb-50">
                            <div class="row">
                                <div class="mx-auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-2 order-lg-1">
                <!--sidebar-categores-box start  -->
                <div class="sidebar-categores-box">
                    <div class="sidebar-title">
                        <h2>Filter By</h2>
                    </div>
                    <!-- filter-sub-area start -->
                    <div class="filter-sub-area">
                    <!-- filter-sub-area start -->
                    <div class="filter-sub-area pt-sm-10 pt-xs-10">
                        <h5 class="filter-sub-titel">Vehicle Type</h5>
                        <div class="categori-checkbox">
                            <ul>
                                <li><a href="#">Bridal Car (1)</a></li>
                                <li><a href="#">SUV Car (3)</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- filter-sub-area end -->
                    <!-- filter-sub-area start -->
                    <div class="filter-sub-area pt-sm-10 pt-xs-10">
                        <h5 class="filter-sub-titel">Vehicle Brand</h5>
                        <div class="categori-checkbox">
                            <ul>
                                <li><a href="#">Toyota (1)</a></li>
                                <li><a href="#">Honda (1)</a></li>
                                <li><a href="#">Ford (1)</a></li>
                            </ul>
`                        </div>
                    </div>
                    <!-- filter-sub-area end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wraper Area End Here -->

@endsection
