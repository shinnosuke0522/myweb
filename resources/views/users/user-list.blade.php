@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="display: inline-block; width: 100%;">
            <div style="width: 20%; display: inline-block">
            <h1 class="pageTitle">User List</h1>
            </div>
            <div style="width: 70%; display: inline-block;">
                <a href="/users/excel-export">Export Users Information in Excel</a>
            </div>
        </div>
        <div class="card">
            <div class="list-group">
                @foreach ($users as $user)
                    <a href="/users/{{$user->id}}" style="color: red;">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="/avatars/{{$user->avatar}}" class="list_avatar">
                                </div>
                                <div class="col-sm-10" style="font-size:18px;">
                                    {{$user->name}}
                                </div>
                            </div>
                        </li>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection