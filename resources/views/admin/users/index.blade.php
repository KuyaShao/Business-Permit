@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <div class="d-flex align-items-center pb-3">
                                <div class="h4">User Info</div>
                            </div>
                            <a class="btn btn-primary" href="{{route('admin.users.create')}}">Add User</a>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <div class="d-flex align-items-center pb-3">
                                <div class="h5">Over all User: <span id="total_records">{{$user->count()}}</span></div>
                            </div>
                            <input type="text" class="form-controller" id="search" name="search" placeholder="Search User">


                        </div>
                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>Permit Number</th>
                                <th>Taxpayer Name</th>
                                <th>Bussiness Name</th>
                                <th>Line of Bussiness</th>
                                <th>QR CODE</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $users)
                                <tr>
                                    <td>{{$users->permit_no}}</td>
                                    <td>{{$users->name}}</td>
                                    <td>{{$users->bname}}</td>
                                    <td>{{$users->lob}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route("admin.users.show",$users->id)}}">Print</a></td>
                                    <td>
                                        <a class="btn btn-success" href="{{route('admin.users.edit',$users->id)}}">Edit</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">{{$user->links()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
