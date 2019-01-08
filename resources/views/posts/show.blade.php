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

                                    <a href="{{ url('posts') }}" class="btn btn-danger" style="color: #fff">
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
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endif
                    </div>
                    Written on {{$post->created_at}} by {{$post->user->name}}
                </div>
            </div>
            <div class="addcomment">
                @if(!Auth::guest())
                    <div style="width: 100%; height: auto; padding: 20px 0;">
                        <div style="width: 65px; height: 65px; display: inline-block; vertical-align: middle;">
                            <img style="width: 100%; height: 100%; border-radius: 50%;" src="/avatars/{{Auth::User()->avatar}}">
                        </div>
                        <div style="display: inline-block; vertical-align: middle; margin-left: 10px; width: calc(100% - 80px); min-height: 65px; margin-left: 10px; padding: 5px 10px; font-size: .9rem; color: #555; background-color: #c6e0f5">
                            {!! Form::open([ 'action' => ['CommentsController@store', $post->id],'method' => 'POST']) !!}
                            <div class="form-group" style="margin-bottom: 3px;">
                                {{Form::text('body', '', ['class' => 'form-control', 'placeholder' => 'Join the conversation...'])}}
                            </div>
                            <div class="form-group">
                                {{Form::submit('Submit', ['class' => 'float-right btn btn-primary btn-sm'])}}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
            <div class="commentsection">
                @if($comments)
                    @foreach($comments as $comment)
                        <div style="width: 100%; height: auto; padding: 20px 0;">
                            <div style="width: 65px; height: 65px; display: inline-block; vertical-align: middle;">
                                <img style="width: 100%; height: 100%; border-radius: 50%;" src="/avatars/{{$comment->user->avatar}}">
                            </div>
                            <div style="display: inline-block; vertical-align: middle; width: calc(100% - 80px); min-height: 65px; margin-left: 10px; padding: 5px 10px; font-size: .9rem; color: #555; background-color: #c6e0f5">
                                <div style="width: 95%; display: inline-block;">
                                    <p style="margin: 0px; font-size: x-small">By <a href="/users/{{$comment->user_id}}" style="">{{$comment->user->name}}</a> on {{$comment->created_at}}</p>
                                    <p style="margin-top: -2px; word-break: break-all">{{$comment->body}}</p>
                                </div>
                                @if(!Auth::guest())
                                    @if(Auth::User()->id == $comment->user_id)
                                        <div style="width: 4%; display: inline-block">
                                            <form method="post"
                                              action="{{ action('CommentsController@destroy', $comment->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link">
                                                <span style="color: red" class="far fa-trash-alt fa-lg"></span>
                                            </button>
                                        </form>
                                        </div>
                                    @endif
                                @endif


                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            </div>
        @else
            <p style="color:white">Post with that ID does not exist.</p>
        @endif
    </div>
@endsection
