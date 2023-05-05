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
                        @foreach($vehicle_img->where('vehicle_id', $vehicle->id) as $img)
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" data-gall="myGallery">
                                    <img src="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" alt="product image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="product-details-thumbs slider-thumbs-1">   
                        @foreach($vehicle_img->where('vehicle_id', $vehicle->id) as $img)
                            <div class="sm-image"><img src="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" alt="product image thumb"></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content">
                    <div class="product-info">
                        <h2><a href="{{route('owner.car', $owner->id)}}">{{$owner_name ?? 'N/A'}}</a></h2>
                        <span class="product-details-ref">Vehicle Brand:</span> {{$brands->brand ?? 'N/A'}}<br>
                        <span class="product-details-ref">Vehicle Model:</span> {{$brands->brand ?? 'N/A'}} - {{$vehicle->model_year}}<br>
                        <span class="product-details-ref">Seater Capacity:</span> {{$vehicle->seating_cap}}<br>
                        <span class="product-details-ref">Booking Type:</span> 
                        @foreach($type_name as $types)
                            <span>{{$types ?? 'N/A'}}</span>
                            @if( !$loop->last)
                                ,
                            @endif
                        @endforeach<br>
                        <div class="product-desc mt-4">
                            <label for="">Description: </label>
                            {{$vehicle->description}}
                        </div>
                        <div>
                            <span class="{{($vehicle->is_approved == 'Approved')? 'bg-success' : 'bg-danger'}} text-white rounded p-1">{{($vehicle->is_approved == 'Approved')? 'Available' : 'Not Available'}}</span>
                        </div>
                        @if($vehicle->is_approved == 'Approved')
                        <div class="single-add-to-cart">
                            <div class="cart-quantity">
                                <a type="button" class="add-to-cart col-sm-12 col-lg-4 m-1 text-center" href="{{route('add.cart',['vehicle_id' => $vehicle->id , 'owner_id' => $owner->id])}}">Add to cart</a>
                                <a type="button" class="add-to-cart col-sm-12 col-lg-4 m-1 text-center" vehicle_id="{{$vehicle->id}}" owner_id="{{$owner->id}}" data-toggle="modal" data-target="#booknow">Book Now</a>
                            </form>
                        </div>
                        @else

                        @endif
                    </div>
                </div>
            </div> 
        </div>

    </div>
</div>

<div class="modal fade" id="booknow">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <form action="{{route('add.booking.modal')}}" method="post" id="book_frm">
                @csrf -->
                <input type="hidden" name="vehicle_id">
                <input type="hidden" name="owner_id">
                <!-- Modal body -->
                <div class="modal-body text-center">
                    <i class="fa fa-question-circle fa-5x text-info"></i><br>
                    Are you sure you want to Book this vehicle?
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Close</button>
                    <a href="{{route('')}}" class="btn btn-info">Yes</a>
                    <!-- <button type="submit" class="btn btn-info">Yes</button> -->
                </div>
            <!-- </form> -->
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
                    @foreach($o_t_brand as $vehicle)                
                        <div class="col-lg-12">
                            <div class="single-product-wrap">
                                <div class="product-image static-image">
                                    <a href="{{route('vehicle.details', $vehicle->id)}}">
                                        @foreach($vehicle_img->where('vehicle_id', $vehicle->id)->take(1) as $img)
                                        <img src="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" alt="VRMS Car's">
                                        @endforeach
                                    </a>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a><span class="product-details-ref">Brand:</span> {{$brands->brand ?? 'N/A'}}</a><br>
                                                <a><span class="product-details-ref">Model:</span> {{$vehicle->vehicle_name . " - " .$vehicle->model_year}}</a><br>
                                                <a><span class="product-details-ref">Seater:</span> {{ $vehicle->seating_cap }}</a><br>
                                                <a><span class="product-details-ref">Status:</span> {{ ($vehicle->is_approved == 'Approved')? 'Available' : ''}}</a><br>
                                            </h5>
                                        </div>
                                        @foreach($vehicle->assign_vehicle_owner->take(1) as $owner)
                                            @foreach($owners->where('id', $owner->owner_id)->take(1) as $owner)
                                            <h4><a class="product_name" href="{{route('owner.car', $owner->id)}}">{{ $owner->owner_fname[0] . ". " . $owner->owner_lname[0]}}.</a></h4>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            
                                            <li class="add-cart active">
                                                <a href="{{route('add.cart',['vehicle_id' => $vehicle->id , 'owner_id' => $owner->id])}}">Add to cart</a>
                                            </li>
                                            <li><a href="{{route('vehicle.details', $vehicle->id)}}" class="quick-view-btn"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $('#booknow').on('show.bs.modal', function (e) {
        var opener=e.relatedTarget;
        var vehicle_id=$(opener).attr('vehicle_id');
        var owner_id=$(opener).attr('owner_id');
        $('#book_frm').find('[name="vehicle_id"]').val(vehicle_id);
        $('#book_frm').find('[name="owner_id"]').val(owner_id);
    });
</script>
@endpush