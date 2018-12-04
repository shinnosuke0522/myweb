@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary" href="/posts/create" role="button" style="margin-bottom: 15px">Create Post</a>
        <h1>Your Posts</h1>
        @if(count($posts) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>
                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                    <td>
                        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </table>
        @else
            <p>You have no posts.</p>
        @endif
    </div>
@endsection
