@extends('layouts.app')

@section('title')
User Reservation Form |
@endsection

@section('breadcrumbs')
Reservation Form
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="login-form">
                    <h4 class="login-title">{{ __('Reservation Form') }}</h4>
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-12">
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
                                    </div>
                                </div>
                            </div> 
                        </div>
                    
                        
                        <div class="row mb-3">
                            <label for="dtpickup" class="col-md-4 col-form-label text-md-end">{{ __('Date Pick-Up') }}</label>

                            <div class="col-md-6">
                                <input id="dtpickup" type="datetime-local" class="form-control @error('dtpickup') is-invalid @enderror" name="dtpickup" value="{{ old('dtpickup') }}" required autocomplete="dtpickup" autofocus placeholder="Input Your Last Name">

                                @error('dtpickup')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dtreturn" class="col-md-4 col-form-label text-md-end">{{ __('Date Pick-Up') }}</label>

                            <div class="col-md-6">
                                <input id="dtreturn" type="datetime-local" class="form-control @error('dtreturn') is-invalid @enderror" name="dtreturn" value="{{ old('dtreturn') }}" required autocomplete="dtreturn" autofocus placeholder="Input Your Last Name">

                                @error('dtreturn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dtpurpose" class="col-md-4 col-form-label text-md-end">{{ __('Purpose') }}</label>

                            <div class="col-md-6">
                                <input id="dtpurpose" type="text" class="form-control @error('dtpurpose') is-invalid @enderror" name="dtpurpose" value="{{ old('dtpurpose') }}" required autocomplete="dtpurpose" autofocus placeholder="Input Your Purpose">

                                @error('dtpurpose')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="register-button mt-0">
                                    {{ __('Reserve') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
