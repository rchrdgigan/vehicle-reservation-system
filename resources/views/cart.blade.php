@extends('layouts.app')

@section('content')
<!--Wishlist Area Strat-->
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
                                <tr>
                                    <td class="li-product-remove"><a><i class="fa fa-times"></i></a></td>
                                    <td class="li-product-thumbnail"><a href="#"><img height="75" src="{{asset('images/vrms-logo.png')}}"></a></td>
                                    <td class="li-product-name"><a href="#">Toyota</a></td>
                                    <td class="li-product-type"><span class="type">Bridal Car</span></td>
                                    <td class="li-product-model"><span class="model">Innova - 2018</span></td>
                                    <td class="li-product-seater"><span class="seater">6</span></td>
                                    <td class="li-product-owner"><span class="owner">Pulano</span></td>
                                    <td class="li-product-add-cart"><a href="">Book</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Wishlist Area End-->

@endsection