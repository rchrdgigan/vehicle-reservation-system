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
        
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Plate Number</label>
                            <input type="text" name="plate_no">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Expiration</label>
                            <div class="input-groupicon">
                                <input type="date" class="form-control" name="vehicle_exp">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Name</label>
                            <input type="text" name="vehicle_name">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Model Year</label>
                            <input type="text" name="model_year">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Brand</label>
                            <select class="select2" name="brand_id">
                                <option>Honda</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Vehicle Type</label>
                            <select class="select2" name="type_id[]" multiple="">
                                <option>Bridal Car</option>
                                <option>Sports Car</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Seating Capacity</label>
                            <input type="text" name="seating_cap">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <table class="table" id="dynamic_field">  
                        <tr> 
                            <div class="form-group"> 
                                <label>Photos Images:</label>                    
                                <td><input multiple type="file" name="p_photo[]" placeholder="Photos" class="form-control name_list" required accept="image/*" /></td> 
                                <td><button type="button" id="add" name="add" class="btn btn-success col-lg-12">Add More</button></td>  
                            </div>
                        </tr>  
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <a href="javascript:void(0);" class="btn btn-submit me-2">Save</a>
                        <a href="productlist.html" class="btn btn-cancel">Cancel</a>
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