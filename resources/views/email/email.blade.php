@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card email-form">
        <h1>Question</h1>
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