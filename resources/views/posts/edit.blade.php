@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body edit-card-body">   
                <h1 style="color: red" class="mb-4 card-title">Edit Post</h1>
                {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST']) !!}

                    <div class="form-group">
                        {{Form::label('title', 'Title', ['class' => 'contntsLabel'])}}
                        {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('body', 'Body', ['class' => 'contntsLabel'])}}
                        {{Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Write something interesting'])}}
                    </div>

                    {{Form::hidden('_method', 'PUT')}}
                    {{-- {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} --}}
                    <button type="submit" class="float-right mr-5 btn btn-primary btn-lg">
                        submit
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
