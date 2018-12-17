@extends('layouts.app')

@section('content')
    <div class="container">
         <h1 class="pageTitle"> User Detail </h1>
         <div class="card">
             <br>
            <div class="row">
                <div class="col-sm-3 profile-left">
                    <img src="/avatars/{{$selected_user->avatar}}" class="avatar_photo">
                </div>
                
                <div class="col-sm-9 profile-right" style="font-size: 20px;">
                    Name  : {{$selected_user->name}} <br>
                    Email : {{$selected_user->email}}<br>
                    Bio   : {{$selected_user->bio}}<br>
                    <br>
                    @if(!Auth::guest())
                        @if(Auth::User()->id == $selected_user->id)
                            <a class="btn btn btn-danger"
                               href="{{action('ProfileController@edit')}}">
                                 Edit Your Profile
                            </a>
                        @endif
                    @endif
                    <a href={{ url('users') }} class="btn btn-danger">
                        Back
                    </a>
                </div>
            </div>
            <br>
            @if(!count($selected_user->posts)==0)
                <div class="mt-2">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h3 class="ml-2"> Post List </h3>
                        </li>
                        @foreach ($selected_user->posts as $post)
                            <a href="/posts/{{$post->id}}" style="color: red;">
                                <li class="list-group-item" style="font-size: 18px;">
                                    {{$post->title}}
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            @endif
         </div>
    </div>
@endsection