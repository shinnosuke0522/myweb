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

                    {{-- Error message  --}}
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-warning" role="alert">
                            <strong>Error : </strong>{{$error}}
                        </div>
                        @endforeach
                    @endif
                    
                    <form method="post" action="{{ route('user_update_profile') }}"enctype='multipart/form-data'>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="avatars/{{$user->avatar}}" class="avatar_photo" style="margin-top:50px;">
                                <label>Update Profile Image</label>
                                <input type="file" name="avatar" class="btn btn-sm">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            </div>

                            <div class="col-sm-8">
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
                                        onKeyUp="countLength(value, 'counter');" name="bio">{{$user->bio}}
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-update-profile">
                                    Update Profile
                                </button>     
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection