@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                       <p class="text-center"> {!!
                            QrCode::size(300)->generate('Name: '.auth()->user()->name.'
'.'Business Name: '. auth()->user()->bname.'
'.'Line of Business: '. auth()->user()->lob.'
'.'Issued By: '. auth()->user()->issued.'
'.'Position: '.'Admin Assistant IV')!!}</p>
                    <p class="text-center">Scan This Qr Code</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
