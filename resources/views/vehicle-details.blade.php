@extends('layouts.app')

@section('title')
Vehicle Details |
@endsection

@section('breadcrumbs')
Details of Vehicle
@endsection

@section('content')

<div class="content-wraper">
    <div class="container">

        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">

                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="{{asset('images/na/car-not-avail.jpg')}}" data-gall="myGallery">
                                <img height="500" src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="{{asset('images/na/car-not-avail.jpg')}}" data-gall="myGallery">
                                <img height="500" src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="{{asset('images/na/car-not-avail.jpg')}}" data-gall="myGallery">
                                <img height="500" src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="{{asset('images/na/car-not-avail.jpg')}}" data-gall="myGallery">
                                <img height="500" src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="{{asset('images/na/car-not-avail.jpg')}}" data-gall="myGallery">
                                <img height="500" src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image">
                            </a>
                        </div>

                    </div>
                    <div class="product-details-thumbs slider-thumbs-1">   

                        <div class="sm-image"><img src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image thumb"></div>
                        <div class="sm-image"><img src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image thumb"></div>
                        <div class="sm-image"><img src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image thumb"></div>
                        <div class="sm-image"><img src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image thumb"></div>
                        <div class="sm-image"><img src="{{asset('images/na/car-not-avail.jpg')}}" alt="product image thumb"></div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content">
                    <div class="product-info">
                        <h2><a href="{{route('owner.car')}}">Owenrs Name</a></h2>
                        <span class="product-details-ref">Vehicle Brand:</span> Toyota<br>
                        <span class="product-details-ref">Vehicle Model:</span> Innova - 2018<br>
                        <span class="product-details-ref">Seater Capacity:</span> 6<br>
                        <span class="product-details-ref">Booking Type:</span> Bridal Car, Van, Sports Car, Party Car<br>
                        <div class="product-desc mt-4">
                            <label for="">Description: </label>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo repellendus reiciendis commodi perspiciatis itaque, nihil cum exercitationem adipisci hic minus beatae dolorum eveniet similique deleniti corrupti fugit fuga vero ipsam?
                        </div>
                        <div>
                            <span class="bg-success text-white rounded p-1">Available</span>
                        </div>
                        <div class="single-add-to-cart">
                            <form action="#" method="POST" class="cart-quantity">
                                <a type="button" class="add-to-cart col-sm-12 col-lg-4 m-1 text-center" href="{{route('user.cart')}}">Add to cart</a>
                                <button type="submit" class="add-to-cart col-sm-12 col-lg-4 m-1 text-center">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

    </div>
</div>

<section class="product-area li-laptop-product pt-30 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Other vehicle in the same brand:</span>
                    </h2>
                </div>
                
                <div class="row">
                    <div class="product-active owl-carousel">

                        <div class="col-lg-12">
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{asset('images/na/car-not-avail.jpg')}}">
                                        <img src="{{asset('images/na/car-not-avail.jpg')}}" alt="VRMS Car's">
                                    </a>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a><span class="product-details-ref">Brand:</span> Toyota</a><br>
                                                <a><span class="product-details-ref">Model:</span> Innova - 2018</a><br>
                                                <a><span class="product-details-ref">Seater:</span> 6</a><br>
                                                <span class="product-details-ref">Booking Type:</span> Bridal Car, Sports Car, Party Car<br>
                                            </h5>
                                        </div>
                                        <h4><a class="product_name" href="#">Owner Name</a></h4>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="{{route('user.cart')}}">Add to cart</a></li>
                                            <li><a href="{{route('vehicle.details')}}" class="quick-view-btn"><i class="fa fa-eye"></i></a></li>
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
</section>
@endsection