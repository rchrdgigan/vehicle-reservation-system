@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Vehicles Info</h4>
            <h6>See vehicle info</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group text-center">
                        <h6 class="h6 fw-bold p-2">Vehicle Plate Number</h6>
                        <span>{{$vehicle->plate_no}}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group text-center">
                        <h6 class="h6 fw-bold p-2">Vehicle Expiration</h6>
                        <span>{{$vehicle->vehicle_exp}}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group text-center">
                        <h6 class="h6 fw-bold p-2">Vehicle Name</h6>
                        <span>{{$vehicle->vehicle_name}}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group text-center">
                        <h6 class="h6 fw-bold p-2">Model Year</h6>
                        <span>{{$vehicle->model_year}}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group text-center">
                        <h6 class="h6 fw-bold p-2">Vehicle Brand</h6>
                        <span>{{$brands->brand ?? 'N/A'}}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group text-center">
                        <h6 class="h6 fw-bold p-2">Vehicle Owner</h6>
                        <span>{{$owner_name ?? 'N/A'}}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group text-center">
                        <h6 class="h6 fw-bold p-2">Vehicle Type</h6>
                        @foreach($type_name as $types)
                            <span>{{$types ?? 'N/A'}}</span>
                            @if( !$loop->last)
                                ,
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group text-center">
                        <h6 class="h6 fw-bold p-2">Seater</h6>
                        <span>{{$vehicle->seating_cap}}</span>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-12">
                    <div class="form-group">
                        <h6 class="h6 fw-bold p-2">Description</h6>
                        <textarea class="form-control" name="description" readonly required>{{$vehicle->description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h6 class="h6 fw-bold p-2">Vehicle Images</h6>
                <div class="row">
                @forelse($vehicle_img->where('vehicle_id', $vehicle->id) as $img)
                    <div class="col-lg-3 col-sm-6 d-flex ">
                        <div class="productset flex-fill">
                            <div class="productsetimg">
                                <a href="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}"><img src="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" alt="img"></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <span class="h4 text-secondary">No Images Available!</span> 
                    </div>
                @endforelse
                </div>
                <div class="col-lg-12 pt-2">
                    <a href="{{route('admin.vehicle.index')}}" class="btn btn-cancel">Back</a>
                    @if($vehicle->is_approved == 'Pending')
                        <button type="submit" class="btn btn-submit me-2 float-end">Approved</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
});
</script>
<script>  
$(document).ready(function(){  
    var i=1;  
    $('#add').click(function(){  
        i++;  
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input multiple type="file" name="p_photo[]" placeholder="Photos" class="form-control name_list" required accept="image/*" /></td></td> <td><button id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>'); 
    });  
    $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
    });  
    $('#submit').click(function(){            
        $.ajax({  
            url:form.attr("action"), 
            method:"POST",  
            data:$("#myForm input").serialize(),
            success:function(data)  
            {  
                console.log(data);  
                $('#myForm input')[0].reset();  
            }  
        });  
    });  
});
</script>
@endpush