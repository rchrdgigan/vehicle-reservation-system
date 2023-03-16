@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Vehicles Add</h4>
            <h6>Create new vehicle</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Vehicle Model</label>
                        <input type="text">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Vehicle Type</label>
                        <select class="select">
                            <option>Choose Vehicle Type</option>
                            <option>Bridal Car</option>
                        </select>
                    </div>
                </div>
              
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <a href="javascript:void(0);" class="btn btn-submit me-2">Save</a>
                    <a href="productlist.html" class="btn btn-cancel">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection