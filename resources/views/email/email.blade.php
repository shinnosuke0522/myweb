@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card email-form">

        @if($errors->any())
            <div class="alert alert-warning" role="alert">
                @foreach ($errors->all() as $error)
                    <strong>Error : </strong>{{$error}}<br>
                @endforeach
            </div>
        @endif

        @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
        @endif

        <h1>Quession</h1>
        <form class="mx-6" method="post" action="{{ url('email/send') }}">
            @csrf
            @method('POST')
            {{--mail title --}}
            <div class="form-group">
                <input type="text" name="title" 
                    class="form-control mt-2" placeholder="title" width="500px">
            </div>
            
            <div class="form-group">
                <textarea name="body" class="form-control mt-4" placeholder="Message" width="500px"></textarea>
            </div>

            <button type="submit" class="btn btn-danger btn-lg mb-3">Send</button>
        </form>
    </div>
</div>
@endsection