@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Information</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="avatars/{{$user->avatar}}" class="avatar_photo">
                        </div>
                    
                        <div class="col-sm-9">
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
                    {{-- <img src="avatars/{{$user->avatar}}" class="avatar_photo">
                    Name  : {{$user->name}} <br>
                    Email : {{$user->email}}<br>
                    Bio   : {{$user->bio}}<br>
                    <br>
                    <a class="btn btn-outline-primary"
                         href="{{action('ProfileController@edit')}}">
                        Edit Your Profile
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
