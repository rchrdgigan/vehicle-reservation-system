@extends('layouts.dashboard')

@push('links')
<link rel="stylesheet" href="{{asset('vendor/plugins/select2/css/select2.min.css')}}">
@endpush
@section('content')
<div class="content">
    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Demand Forecasting Rental Report</h5>
                </div>
                <div class="card-body">
                {!! $chart->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="{{asset('vendor/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('vendor/plugins/select2/js/custom-select.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
{!! $chart->script() !!}
@endpush