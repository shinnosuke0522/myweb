@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Written on {{$post->created_at}} by {{$post->user->name}}</h6>
                        <p class="card-text">{{$post->body}}</p>
                    </div>
                </div>
            @endforeach
            {{$posts->links()}}
        @else
            <p>No posts to show.</p>
        @endif
    </div>
@endsection
