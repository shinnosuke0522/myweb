@extends('layouts.app')

@section('content')
    <div class="container">
        @if($post)
            <div class="card flex-row flex-wrap">
                <div class="card-header border-0">
                    <img style="width: 400px" src="/storage/post_censored_watermark/{{$post->cover_image}}"
                         onmouseover="this.src='/storage/cover_images/{{$post->cover_image}}';"
                         onmouseout="this.src='/storage/post_censored_watermark/{{$post->cover_image}}';"/>
                </div>
                <div class="card-block px-2">
                    <h2 class="card-title text-center">{{$post->title}}</h2>
                    <p class="card-text">{{$post->body}}</p>
                </div>
                <div class="w-100"></div>
                <div class="card-footer w-100 text-muted">
                    <div class="auther-option">
                        @if(!Auth::guest())
                            @if(Auth::User()->id == $post->user_id)

                                <form method="post"
                                      action="{{ action('PostsController@destroy', $post->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="/posts/{{$post->id}}/edit">
                                        <span class="far fa-edit fa-lg edit-icon"></span>
                                    </a>

                                    <button type="submit" class="btn btn-link">
                                        <span class="far fa-trash-alt fa-lg"></span>
                                    </button>

                                    <a href={{ url('posts') }} class="btn btn-danger" style="color: #fff">
                                    Go Back
                                    </a>

                                </form>
                            @endif
                        @endif
                    </div>
                    Written on {{$post->created_at}} by {{$post->user->name}}
                </div>
            </div>
            </div>
        @else
            <p style="color:white">Post with that ID does not exist.</p>
        @endif
    </div>
@endsection
