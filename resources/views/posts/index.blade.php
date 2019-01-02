@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pageTitle">Posts</h1>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0">
                        <a href="/posts/{{$post->id}}">
                        <img style="width: 225px" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                        </a>
                    </div>
                    <div class="card-block px-2">
                        <a href="/posts/{{$post->id}}">
                        <h4 class="card-title" style="color:red;">{{$post->title}}</h4>
                        </a>
                        <p class="card-text">{{$post->body}}</p>
                    </div>
                    <div class="w-100"></div>
                    <div class="card-footer w-100 text-muted">Written on {{$post->created_at}} by {{$post->user->name}}</div>
                </div>
                <div style="height: 4px"></div>
            @endforeach
            {{$posts->links()}}
        @else
            <p style="color:white">No posts to show.</p>
        @endif
    </div>
@endsection
