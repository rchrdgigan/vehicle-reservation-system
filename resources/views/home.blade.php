@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Profile</h4>
            <h6>User Profile</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
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
            </div>
            <form action="{{route('update.user')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="profile-set">
                    <div class="profile-head">
                    </div>
                    <div class="profile-top">
                        <div class="profile-content">
                            <div class="profile-contentimg">
                                @if(isset(auth()->user()->image_prof))
                                <img src="{{asset('/storage/user_profile/'. auth()->user()->image_prof)}}" alt="img" id="blah">
                                @else
                                <img src="{{asset('vendor/img/profiles/avator1.jpg')}}" alt="img" id="blah">
                                @endif
                                <div class="profileupload">
                                    <input type="file" id="imgInp" name="image_prof">
                                    <a href="javascript:void(0);"><img src="{{asset('vendor/img/icons/edit-set.svg')}}" alt="img"></a>
                                </div>
                            </div>
                            <div class="profile-contentname">
                                <h2>{{auth()->user()->fname . " " . auth()->user()->lname}}</h2>
                                <h4>Updates Your Photo and Personal Details.</h4>
                            </div>
                        </div>

                        <div class="dropdown ms-auto">
                            <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                            <ul class="dropdown-menu dropdown-menu-end">

                                <li class="dropdown-item">
                                    <a type="button" class="p-2 text-dark" style="margin:-8px;" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fa fa-car me-2"></i> Start Your Own Car <br> Rental Business
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a type="button" class="p-2 text-dark" style="margin:-10px; margin-left: -3px;" data-bs-toggle="modal" data-bs-target="#changepassModal">
                                    <i class="fa fa-key me-2"></i> Change Password
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="Enter Your First Name" name="fname" value="{{auth()->user()->fname}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" placeholder="Enter Your Last Name" name="lname" value="{{auth()->user()->lname}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" placeholder="Enter Your Email" name="email" value="{{auth()->user()->email}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" 
                                maxlength="11" placeholder="Enter Your Cellphone Number" name="cpnumber" value="{{auth()->user()->cpnumber}}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" placeholder="Enter Your Address" name="address" value="{{auth()->user()->address}}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-submit me-2">Update</button>
                </div>
            </form>
        </div>
        
    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="changepassModal" tabindex="-1" aria-labelledby="changepassModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="form-validation">
            <form action="{{route('update.password')}}" method="post" class="needs-validation">
            @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="changepassModalLabel">Change Password</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Old Password
                        </label>
                        <div class="col-lg-12">
                            <input type="password" name="old_password" class="form-control" id="validationCustom01" placeholder="Enter your current password.." required="">
                            <div class="invalid-feedback">
                                Please enter your old password.
                            </div>
                        </div>
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            New Password
                        </label>
                        <div class="col-lg-12">
                            <input type="password" name="new_password" class="form-control" id="validationCustom01" placeholder="Enter your new password.." required="">
                            <div class="invalid-feedback">
                                Please enter your new password.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Confirmation Password
                        </label>
                        <div class="col-lg-12">
                            <input type="password" name="new_password_confirmation" class="form-control" id="validationCustom01" placeholder="Enter your new password.." required="">
                            <div class="invalid-feedback">
                                Please enter your new password.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="form-validation">
            <form action="{{route('create.owner')}}" method="post" class="needs-validation">
            @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Setup Owner Account</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Owner's First Name
                        </label>
                        <div class="col-lg-12">
                            <input type="password" name="ofname" class="form-control" id="validationCustom01" placeholder="Enter your first name.." required>
                            <div class="invalid-feedback">
                                Please enter your first name.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Owner's Last Name
                        </label>
                        <div class="col-lg-12">
                            <input type="password" name="olname" class="form-control" id="validationCustom01" placeholder="Enter your last name.." required>
                            <div class="invalid-feedback">
                                Please enter your last name.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-12 col-form-label" for="validationCustom01">
                            Owner's Contact Number
                        </label>
                        <div class="col-lg-12">
                            <input type="password" name="ocontact" class="form-control" id="validationCustom01" placeholder="Enter your contact.." required>
                            <div class="invalid-feedback">
                                Please enter your contact.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection