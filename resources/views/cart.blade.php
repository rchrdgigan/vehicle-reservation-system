@extends('layouts.app')

@section('title')
Your Cart |
@endsection

@section('breadcrumbs')
Cart List
@endsection

@section('content')
<div class="wishlist-area pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">remove</th>
                                    <th class="li-product-thumbnail">Images</th>
                                    <th class="cart-product-name">Brand</th>
                                    <th class="li-product-type">Types</th>
                                    <th class="li-product-model">Model</th>
                                    <th class="li-product-seater">Seater</th>
                                    <th class="li-product-owner">Owner</th>
                                    <th class="li-product-add-cart">Check Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts->where('status','Cart')->where('user_id',auth()->user()->id) as $cart)
                                <tr>
                                    <td class="li-product-remove">
                                        <a id="{{$cart->id}}" data-toggle="modal" data-target="#delCart"><i class="fa fa-times"></i></a>
                                    </td>
                                    @foreach($cart->vehicle_img->where('vehicle_id', $cart->vehicle_id)->take(1) as $img)
                                    <td class="li-product-thumbnail">
                                        <a href="{{route('vehicle.details',  $cart->vehicle_id)}}">
                                            <img height="75"  src="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" alt="vehicle">
                                        </a>
                                    </td>
                                    @endforeach
                                    <td class="li-product-name"><a href="#">{{$cart->brand_name}}</a></td>
                                    <td class="li-product-type">
                                    @foreach($cart->vehicle_type as $typeid)
                                        @foreach($types->where('id', $typeid->type_id)->take(1) as $type)
                                        <span>{{$type->type ?? 'N/A'}}</span>
                                        @if( !$loop->last)
                                            ,
                                        @endif
                                        @endforeach
                                    @endforeach</td>
                                    <td class="li-product-model"><span class="model">{{$cart->vehicle_name. " - " .$cart->model_year}}</span></td>
                                    <td class="li-product-seater"><span class="seater">{{$cart->seating_cap}}</span></td>
                                    <td class="li-product-owner"><span class="owner">{{$cart->owner_name}}.</span></td>
                                    <td class="li-product-add-cart">
                                       <a href="{{route('vehicle.reservation',$cart->vehicle_id)}}" class="btn btn-sm btn-dark">Book</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete-->
<div class="modal fade" id="delCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove...?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('remove.cart')}}" id="delete_frm" method="post">
        @method('DELETE')
        @csrf
        <div class="modal-body">
            Are you sure want remove this vehicle in your cart?
            <input type="hidden" id="cartId" name="id">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection

@push('scripts')
<script>
$('#delCart').on('show.bs.modal', function (e) {
    var opener=e.relatedTarget;
    var id=$(opener).attr('id');
    $('#delete_frm').find('[name="id"]').val(id);
});
</script>
@endpush