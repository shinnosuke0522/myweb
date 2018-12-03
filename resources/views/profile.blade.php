@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Information</div>

                <div class="card-body">
                    Name  : {{$user->name}} <br>
                    Email : {{$user->email}}<br>
                    Bio   : {{$user->bio}}<br>
                    <br>
                    <a class="btn btn-outline-primary"
                         href="{{action('ProfileController@edit')}}">
                        Edit Your Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
