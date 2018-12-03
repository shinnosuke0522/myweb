@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                   <h2> Edit User Information </h2>
                </div>
                
                <div class="card-body">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-warning" role="alert">
                            <strong>Error : </strong>{{$error}}
                        </div>
                        @endforeach
                    @endif
                    
                    <form method="post" action="{{ route('user_update') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nameForm"> Name : </label>
                            <input type="text" id="nameForm" name="name"
                                 class="form-control" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="nameForm"> Email Address : </label>
                            <input type="text" id="nameForm"  name="email"
                                class="form-control" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="bioForm"> BIO : </label>
                            <textarea id="bioForm" class="form-control"
                                onKeyUp="countLength(value, 'counter');" name="bio">
                                 {{$user->bio}}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection