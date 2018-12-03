@extends('layouts.app')

@section('content')
    <div class="container">
        @if($post)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$post->title}}</h4>
                    <h5 class="card-subtitle mb-2 text-muted">{{$post->created_at}}</h5>
                    <p class="card-text">{{$post->body}}</p>
                    <a href="/posts/{{$post->id}}/edit" class="card-link">Edit</a>

                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        @else
            <p>Post with that ID does not exist.</p>
        @endif
    </div>
@endsection
