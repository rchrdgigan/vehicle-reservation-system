    
@extends('layouts.app')

@section('title')
Vehicle List |
@endsection

@section('breadcrumbs')
Owner's Vehicle
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
                                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">

                                    <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
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
                                                    <h4><a class="product_name" href="{{route('owner.car')}}">Owner Name</a></h4>
                                                    
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-2 order-lg-1">
                
                <div class="sidebar-categores-box text-center">
                
                    <ul>
                        <li><a href=""><img height="150" width="150" src="{{asset('images/na/car-not-avail.jpg')}}" class="rounded-circle" alt="" /></a></li>
                        <h5 class="p-3">Firstname Lastname
                            <br><span class="font-weight-normal">fname@example.com</span>
                            <br><span class="font-weight-normal">+6391234567910</span>
                        </h5>
                    </ul>
                    
                </div>  

                <div class="sidebar-categores-box">

                    <div class="filter-sub-area">

                    <div class="filter-sub-area pt-sm-10 pt-xs-10">
                        <h5 class="filter-sub-titel">Vehicle Type</h5>
                        <div class="categori-checkbox">
                            
                                <ul>
                                    <li><a href="#">Bridal Car (1)</a></li>
                                    <li><a href="#">SUV Car (3)</a></li>
                                </ul>
                        </div>
                    </div>

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

                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection