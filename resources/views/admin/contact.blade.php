@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Contact Messages</h4>
            <h6>Messages list</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{asset('vendor/img/icons/search-white.svg')}}" alt="img"></a>
                            </div>
                        </div>
                    </div>
                     @if (session('success'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Messages</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($contact as $data)
                            <tr>
                                <td>{{ Carbon\Carbon::parse($data->createdAt)->format('d M Y')}}</td>
                                <td>{{$data->fname}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->subject}}</td>
                                <td>{{$data->message}}</td>
                                <td class="text-center">
                                       <a type="button" data-bs-toggle="modal" id="{{$data->id}}"  data-bs-target="#delModal">
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
        <form action="{{route('admin.contact.destroy')}}" method="post" id="delete_frm">
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