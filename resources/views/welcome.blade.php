@extends('layouts.app')

@section('title')
Welcome to
@endsection

@section('breadcrumbs')
Main Page
@endsection

@section('content')
<div class="slider-with-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="slider-area">
                    <div class="slider-active owl-carousel">

                        <div class="single-slide align-center-left  animation-style-01 bg-1">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>Car for <span>Rent</span></h5>
                                <h2>Toyota Brand</h2>
                                <h3>Exclusive in <span>Bulan</span></h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="{{route('vehicle.list')}}">Rent Now</a>
                                </div>
                            </div>
                        </div>
                       
                        <div class="single-slide align-center-left animation-style-02 bg-2">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>Car for <span>Rent</span></h5>
                                <h2>Honda Brand</h2>
                                <h3>Exclusive in <span>Bulan</span></h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="{{route('vehicle.list')}}">Rent Now</a>
                                </div>
                            </div>
                        </div>
                       
                        <div class="single-slide align-center-left animation-style-01 bg-3">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>Car for <span>Rent</span></h5>
                                <h2>Ford Brand</h2>
                                <h3>Exclusive in <span>Bulan</span></h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="{{route('vehicle.list')}}">Rent Now</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-area pt-60 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#li-new-product"><span>Featured Car For Rent</span></a></li>
                    </ul>               
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">

                        <div class="col-lg-12">
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{asset('images/na/car-not-avail.jpg')}}" alt="VRMS Car's">
                                    </a>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="#">Sports Car</a><br>
                                                <a href="#">4 Passengers</a><br>
                                                <a href="#">2 Units Available</a><br>
                                                <a href="#">2018 Model</a><br>
                                            </h5>
                                        </div>
                                        <h4><a class="product_name" href="#">Car Brand</a></h4>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="{{route('user.cart')}}">Add to cart</a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
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

@endsection
