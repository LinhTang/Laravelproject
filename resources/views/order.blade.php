@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #ffeee6; font-size: 40px;" >Menu</div>
                   <Order :user="{{auth()->user()}}"></Order>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
