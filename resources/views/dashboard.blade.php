@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body dash-card">

                <div class="dash-top mb-3">
                    <h1>Your Posts</h1>
                    <a class="float-right btn-link creat-btn" href="/posts/create" 
                        role="button" style="margin-bottom: 15px">
                        <span class="fas fa-plus fa-2x"></span>
                    </a>
                    <a class="float-right" style="margin-right: 20px; margin-top: 4px; color: red" href="/userpdf">
                        <span>Download your posts as PDF</span>
                    </a>
                </div>

                <div class="dash-list">
                    @if(count($posts) > 0)
                        <ul class="list-group">
                            @foreach($posts as $post)
                                
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-6 text-center">
                                            <a class="dash-title" href="/posts/{{$post->id}}">
                                                <strong>{{$post->title}}</strong>
                                            </a>
                                        </div>
                                        <div class="col-sm-3">
                                            {{ $post->created_at }}
                                        </div>
                                        <div class="col-sm-3">
                                            <form method="post"
                                            action="{{ action('PostsController@destroy', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/posts/{{$post->id}}/edit" class="mr-1">
                                                <span class="far fa-edit fa-lg edit-icon"></span>
                                            </a>
        
                                            <button type="submit" class="btn btn-link">
                                                <span class="far fa-trash-alt fa-lg"></span>
                                            </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>You have no posts.</p>
                    @endif
                </div>
            </>
        </div>    
    </div>
@endsection
