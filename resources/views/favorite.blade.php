@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="color: white">Your Favorite Posts</h1>
        <div class="card"> 
            @if(count($posts) > 0)
                <ul class="list-group">
                    @foreach($posts as $post)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-11 ">
                                    <a href="/posts/{{$post->id}}" style="color:red;font-size:20px;">
                                        {{$post->title}}
                                    </a>
                                </div>
                                <div class="col-sm-1">
                                    <form method="post"
                                        action="{{ action('FavoriteController@destroy', $post->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link">
                                            <span class="fas fa-star fa-lg" style="color: green"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p> You don't have favorite posts</p>
            @endif
        </div>
    </div>
@endsection