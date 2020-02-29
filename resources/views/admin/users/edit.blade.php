@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create User Information</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.update',$user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Permit Number</label>

                                <div class="col-md-6">
                                    <input id="permit_no"
                                           type="text"
                                           class="form-control @error('permit_no') is-invalid @enderror"
                                           name="permit_no" value="{{ old('permit_no')?? $user->permit_no }}"
                                           placeholder="Ex 2020-"
                                           required autocomplete="permit_no" autofocus>

                                    @error('permit_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Tax Payer Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')?? $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bname" class="col-md-4 col-form-label text-md-right">Bussiness Name</label>

                                <div class="col-md-6">
                                    <input id="bname"
                                           type="text" class="form-control @error('bname') is-invalid @enderror"
                                           value="{{old('name')?? $user->bname}}"
                                           name="bname" required>

                                    @error('bname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lob" class="col-md-4 col-form-label text-md-right">Line of Business</label>

                                <div class="col-md-6">
                                    <input id="lob" type="text"  value="{{old('name')?? $user->lob}}" class="form-control @error('lob') is-invalid @enderror" name="lob" required>

                                    @error('lob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Issued By</label>

                                <div class="col-md-6">
                                    <input id="issued"
                                           type="text"
                                           class="form-control @error('issued') is-invalid @enderror"
                                           name="issued" value="Em R. Lugue"
                                           required autocomplete="permit_no" autofocus>

                                    @error('issued')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Position</label>

                                <div class="col-md-6">
                                    <input id="position"
                                           type="text"
                                           class="form-control @error('position') is-invalid @enderror"
                                           name="position" value="Admin Assistant IV"

                                           required autocomplete="position" autofocus>

                                    @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-success">
                                        Edit Users Information
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
