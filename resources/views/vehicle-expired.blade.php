@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Expired Vehicles List</h4>
            <h6>See your expired vehicles</h6>
        </div>
    </div>

    <div class="card">
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
                        <th>S/N</th>
                        <th>Date Created</th>
                        <th>Name/Model</th>
                        <th>Brand</th>
                        <th>Seater</th>
                        <th>Date Expired</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($avo->where('vehicle_exp', '<' , Carbon\Carbon::now()->format('Y-m-d')) as $vehicle)
                    <tr>
                        <td>{{Carbon\Carbon::now()->format('y').'-'.str_pad($vehicle->id, 5, '0', STR_PAD_LEFT)}}</td>
                        <td>{{ Carbon\Carbon::parse($vehicle->createdAt)->format('d M Y')}}</td>
                        <td>{{$vehicle->vehicle_name . " - " .$vehicle->model_year}}</td>
                        <td>{{ $vehicle->brand_name }}</td>
                        <td>{{ $vehicle->seating_cap }}</td>
                        <td>{{ Carbon\Carbon::parse($vehicle->vehicle_exp)->format('d M Y')}}</td>
                        <td><span class="badges {{($vehicle->is_approved == 'Pending') ? 'bg-lightred' : 'bg-lightgreen'}}">{{ $vehicle->is_approved }}</span></td>
                        <td class="text-center">
                            <a class="me-3" href="{{route('vehicle.show', $vehicle->id)}}">
                                <img src="{{asset('vendor/img/icons/eye.svg')}}" alt="img">
                            </a>
                            <a class="me-3" href="{{route('vehicle.edit', $vehicle->id)}}">
                                <img src="{{asset('vendor/img/icons/edit.svg')}}" alt="img">
                            </a>
                            <a type="button" data-bs-toggle="modal" id="{{$vehicle->id}}"  data-bs-target="#delModal">
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

<!-- Modal -->
<div class="modal fade" id="delModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{route('vehicle.destroy')}}" method="post" id="delete_frm">
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