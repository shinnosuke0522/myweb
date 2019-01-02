@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body edit-card-body">
                <h1 class="mb-4 card-title">Create Post</h1>
                {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
                </div>

                <div class="form-group">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Write something interesting'])}}
                </div>

                <div class="form-group">
                    {{Form::file('cover_image')}}
                    {{Form::submit('Submit', ['class' => 'btn btn-primary float-right'])}}
                </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
