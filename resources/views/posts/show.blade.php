@extends('layouts.app')

@section('content')
    <div class="container">
        @if($post)
            <div class="card flex-row flex-wrap">
                <div class="card-header border-0" style="max-width: 40%">
                    <img style="width: 400px; height: auto;" src="/storage/post_censored_watermark/{{$post->cover_image}}"
                         onmouseover="this.src='/storage/cover_images/{{$post->cover_image}}';"
                         onmouseout="this.src='/storage/post_censored_watermark/{{$post->cover_image}}';"/>
                </div>
                <div class="card-block px-2" style="width: 60%">
                    <h2 class="card-title">{{$post->title}}</h2>
                    <p class="card-text" style="word-break: break-all;">{{$post->body}}</p>
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
                            @else
                                @if($favorite)
                                    <form method="post"
                                        action="{{ action('FavoriteController@destroy', $post->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link">
                                            <span class="fas fa-star fa-lg"></span>
                                        </button>
                                    </form>
                                @else
                                    <form method="post"
                                        action="{{ action('FavoriteController@store', $post->id) }}">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-link">
                                            <span class="far fa-star fa-lg"></span>
                                        <button>
                                    </form>
                                @endif
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
