@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Vehicle</h4>
            <h6>Update vehicle info</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        
            <form action="{{route('admin.vehicle.update', $vehicle->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Plate Number</label>
                            <input type="text" name="plate_no" value="{{$vehicle->plate_no}}" required>
                            @error('plate_no')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Expiration</label>
                            <div class="input-groupicon">
                                <input type="date" class="form-control" name="vehicle_exp" value="{{$vehicle->vehicle_exp}}" required>
                                @error('vehicle_exp')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Name</label>
                            <input type="text" name="vehicle_name" value="{{$vehicle->vehicle_name}}" required>
                            @error('vehicle_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Model Year</label>
                            <input type="text" name="model_year" value="{{$vehicle->model_year}}" required>
                            @error('model_year')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Brand</label>
                            <select class="select2" name="brand_id" required>
                                @foreach($brands as $brand)
                                    <option {{($vehicle->brand_id == $brand->id)? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('brand_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Owner</label>
                            <select class="select2" name="owner_id" required>
                                @foreach($owners as $owner)
                                    @foreach($vehicle->assign_vehicle_owner->take(1) as $assign_owner)
                                        <option {{($assign_owner->owner_id == $owner->id)? 'selected' : ''}} value="{{ $owner->id }}">{{ $owner->owner_fname. " " .$owner->owner_lname }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Type</label>
                            <select class="select2" name="type_id[]" multiple="" required>
                                @foreach($types as $type)
                                    @forelse($vehicle->assign_vehicle_type->where('type_id', $type->id) as $assign_type)
                                        <option {{($assign_type->type_id == $type->id)? 'selected' : ''}} value="{{ $type->id }}">{{ $type->type }}</option>
                                    @empty
                                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                                    @endforelse
                                @endforeach
                            </select>
                            @error('type_id')
                                    <strong class="text-danger">The vehicle type field is required.</strong>
                                @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Seater</label>
                            <input type="text" name="seating_cap" value="{{ $vehicle->seating_cap }}" required>
                            @error('seating_cap')
                                    <strong class="text-danger">The seater field is required.</strong>
                                @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" required>{{ $vehicle->description }}</textarea>
                            @error('description')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                    <label>Photos Images:</label>                    

                        <table class="table" id="dynamic_field">  
                        <tr> 
                            <div class="form-group"> 
                                <td><input multiple type="file" name="p_photo[]" placeholder="Photos" class="form-control name_list" accept="image/*"/></td> 
                                <td><button type="button" id="add" name="add" class="btn btn-success col-lg-12">Add More</button></td>  
                            </div>
                        </tr>
                        </table>
                        @error('p_photo')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                    </div>
                    
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Update</button>
                        <a href="{{route('admin.vehicle.index')}}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>

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