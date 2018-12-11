@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="pageTitle">User Information</h1>

    <div class="card profile-card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3 profile-left">
                    <img src="/avatars/{{$user->avatar}}" class="avatar_photo">
                </div>
            
                <div class="col-sm-9 profile-right">
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
