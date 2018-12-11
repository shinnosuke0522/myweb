@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="pageTitle">Posts</h1>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="card post-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                        </h5>
                        <p class="mb-2 text-muted post-auth">
                            Written on {{$post->created_at}} by {{$post->user->name}}
                        </p>
                        {{-- <p class="card-text">{{$post->body}}</p> --}}
                    </div>
                </div>
            @endforeach
            {{$posts->links()}}
        @else
            <p style="color:white">No posts to show.</p>
        @endif
    </div>
@endsection
