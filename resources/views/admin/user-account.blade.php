@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Users Owner Management</h4>
            <h6>Manage all owner</h6>
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

                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Users Name</th>
                                <th>Users Email</th>
                                <th>Owner Name</th>
                                <th>Owner Contact</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($users->where('is_admin', false) as $user)
                            <tr>
                                <td>{{ Carbon\Carbon::parse($user->createdAt)->format('d M Y')}}</td>
                                <td>{{$user->fname}} {{$user->lname}}</td>
                                <td>{{$user->email}}</td>
                                @if(isset($user->owner->owner_fname) || isset($user->owner->owner_lname))
                                <td>{{$user->owner->owner_fname . " " . $user->owner->owner_lname ?? 'N/A'}}</td>
                                <td>{{$user->owner->contact ?? 'N/A'}}</td>
                                <td class="text-center">
                                    <a class="me-3" href="{{route('admin.user.edit', $user->owner->id)}}">
                                        <img src="{{asset('vendor/img/icons/edit.svg')}}" alt="img">
                                    </a>
                                </td>
                                @else
                                <td>N/A</td>
                                <td>N/A</td>
                                <td class="text-center">
                                    <a class="me-3" href="{{route('admin.user.create', $user->id)}}">
                                        <img src="{{asset('vendor/img/icons/plus.svg')}}" alt="img">
                                    </a>
                                </td>
                                @endif
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
        <form action="#" method="post" id="delete_frm">
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