@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="pageTitle">User Information</h1>

    <div class="card profile-card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3 profile-left">
                    <button class="abatarBtn" data-toggle="modal" data-target="#exampleModal">
                        <img src="/avatars/{{$user->avatar}}" class="avatar_photo">
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div>
                                    <img src="/avatars/{{$user->avatar}}" class="mt-3">
                                    <button type="button" data-dismiss="modal"
                                    class="btn btn-denger float-right">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
