@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Owners</h4>
            <h6>Create update owner info</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <div class="row">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        </div>
            <form action="{{route('admin.user.update', $edit_owner->id)}}" method="post">
                @csrf
                @method('PUT')
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
                            <input type="text" name="owner_fname" value="{{$edit_owner->owner_fname}}">
                            @error('owner_fname')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Owner Last Name</label>
                            <div class="input-groupicon">
                                <input type="text" name="owner_lname" value="{{$edit_owner->owner_lname}}">
                                @error('owner_lname')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact" value="{{$edit_owner->contact}}">
                            @error('contact')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Update</button>
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