@extends('layouts.app')

@section('content')
    <div class="container">
        @if($post)
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">{{$post->title}}</h2>
                    <h5 class="card-subtitle mb-2 text-muted text-right" style="font-size:14px;">
                        by {{$post->user->name}}
                    </h5>
                    <h5 class="card-subtitle mb-2 text-muted text-right" style="font-size:14px;">
                        Written on {{$post->created_at}}
                    </h5>
                    <p class="card-text">{{$post->body}}</p>

                    <div class="auther-option">
                        @if(!Auth::guest())
                            @if(Auth::User()->id == $post->user_id)

                                <form method="post"
                                    action="{{ action('PostsController@destroy', $post->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/posts/{{$post->id}}/edit" class="mr-1">
                                        <span class="far fa-edit fa-2x"></span>
                                    </a>

                                    <button type="submit" class="btn btn-link">
                                        <span class="far fa-trash-alt fa-2x"></span>
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                    
                </div>
            </div>
        @else
            <p>Post with that ID does not exist.</p>
        @endif
    </div>
@endsection
