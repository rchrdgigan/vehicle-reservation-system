@extends('layouts.app')

@section('title')
About Us |
@endsection

@section('breadcrumbs')
About Form
@endsection

@push('links')
<style type="text/css">
    .container .row .image {
        width: 100%;
        min-height: 400px;
        background-image: url('images/slider/1.jpg');
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: cover;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row mb-2">
         <div class="li-product-tab">
                <ul class="nav li-product-menu">
                    <li><a class="active" data-toggle="tab" href="#li-new-product"><span>Services</span></a></li>
                </ul>               
        </div>
    </div>
    <div class="row justify-content-center">

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="row">
        <div class="image">
        </div>
    </div>
</div>
@endsection
