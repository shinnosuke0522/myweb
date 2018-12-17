<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.user-list',['users'=>$users]);
    }
    public function show($id)
    {
        $selected_user = User::find($id);
        return view('users.user-detail')->with('selected_user', $selected_user);
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
