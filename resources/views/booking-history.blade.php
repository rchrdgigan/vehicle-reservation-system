@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Booking History</h4>
            <h6>See all your booking history</h6>
        </div>
    </div>

    <div class="card">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
                        <th>Images</th>
                        <th>Name/Model</th>
                        <th>Brand</th>
                        <th>Seater</th>
                        <th>Owner</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($books->where('status', '<>', 'Cart')->where('user_id',auth()->user()->id) as $book)
                        <tr>
                            <td>
                            @foreach($book->vehicle_img->where('vehicle_id', $book->vehicle_id)->take(1) as $img)
                                <a href="{{route('vehicle.details',  $book->vehicle_id)}}">
                                    <img width="50" src="{{asset('/storage/vehicle_image/'. $img->vehicle_img)}}" alt="vehicle">
                                </a>
                            @endforeach
                            </td>
                            <td>{{$book->brand_name}}</td>
                            <td>{{$book->vehicle_name. " - " .$book->model_year}}</td>
                            <td>{{$book->seating_cap}}</td>
                            <td>{{$book->owner_name}}.</td>
                            <td><a class="{{($book->status == 'Pending')? 'bg-danger' : ($book->status == 'Cancelled' ? 'bg-secondary' : 'bg-success')}} text-white rounded">{{$book->status}}</a></td>
                            <td>
                                @if($book->status == 'Pending')
                                <button type="button" id="{{$book->id}}" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#cancelModal"><i class="fa fa-times"></i> Cancel</a>
                                @endif
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
<div class="modal fade" id="cancelModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{route('cancel.booking')}}" method="post" id="cancel_frm">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel...?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input name="id" type="hidden">
                <p>Are you sure you want to cancel this booking?</p>
            </div>
            <div class="modal-footer float-end">
                <button type="submit" class="btn btn-danger">Yes</button>
                <a class="btn btn-cancel" data-bs-dismiss="modal" aria-label="Close">No</a>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$('#cancelModal').on('show.bs.modal', function (e) {
    var opener=e.relatedTarget;
    var id=$(opener).attr('id');
    $('#cancel_frm').find('[name="id"]').val(id);
});
</script>
@endpush