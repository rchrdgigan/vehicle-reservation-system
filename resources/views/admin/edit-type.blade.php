@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Types</h4>
            <h6>Update your types</h6>
        </div>
    </div>
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
        <div class="col-md-4">
            <form action="{{route('admin.vehicle.type.update', $edit_type->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Vehicles Types</label>
                                    <input type="text" name="type" value="{{$edit_type->type}}">
                                    @error('type')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <a href="{{route('admin.vehicle.type.index')}}" class="btn btn-cancel me-2">Cancel</a>
                                <button type="submit" class="btn btn-submit me-2">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-8">

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{asset('vendor/img/icons/search-white.svg')}}" alt="img"></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Vehicle Types</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($types as $type)
                            <tr>
                                <td>{{ Carbon\Carbon::parse($type->createdAt)->format('d M Y')}}</td>
                                <td>{{$type->type}}</td>
                                <td class="text-center">
                                    <a class="me-3" href="{{route('admin.vehicle.type.edit', $type->id)}}">
                                        <img src="{{asset('vendor/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                    <a type="button" data-bs-toggle="modal" id="{{$type->id}}"  data-bs-target="#delModal">
                                        <img src="{{asset('vendor/img/icons/delete.svg')}}" alt="img">
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
   
</div>

<!-- Modal -->
<div class="modal fade" id="delModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{route('admin.vehicle.type.destroy')}}" method="post" id="delete_frm">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deleting...?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input name="id" type="hidden">
                <p>Are you sure you want to delete this data?</p>
            </div>
            <div class="modal-footer float-end">
                <button type="submit" class="btn btn-danger">Yes</button>
                <a class="btn btn-cancel" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$('#delModal').on('show.bs.modal', function (e) {
    var opener=e.relatedTarget;
    var id=$(opener).attr('id');
    $('#delete_frm').find('[name="id"]').val(id);
});
</script>
@endpush