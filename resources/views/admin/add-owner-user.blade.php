@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Owners Add</h4>
            <h6>Create new owner</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        
            <form action="{{route('admin.user.store', $users->id)}}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{$users->id}}">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="form-group">
                            <h6>Users Name</h6>
                            <span>{{$users->name}}</span>
                        </div>
                        <div class="form-group">
                            <h6>Users Email</h6>
                            <span>{{$users->email}}</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Owner First Name</label>
                            <input type="text" name="owner_fname">
                            @error('owner_fname')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Owner Last Name</label>
                            <div class="input-groupicon">
                                <input type="text" name="owner_lname">
                                @error('owner_lname')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact">
                            @error('contact')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Save</button>
                        <a href="{{route('admin.user.index')}}" class="btn btn-cancel">Cancel</a>
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